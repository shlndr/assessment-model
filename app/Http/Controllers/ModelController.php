<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ModelController extends Controller
{
	
	public function index()
    {
		$data['data'] = DB::table('ram_tran_header')
					->get();

					//dd($data);
    	return view('models.index',$data);
    }

    public function add()
    {

    	$data['items'] = DB::table('ram_category')
		    					->where('RAM_CAT_LOV_FLG', 'No')
		    					->orderBy('RAM_ORDER_NO','asc')
		    					->limit(7)
		    					->get()
		    					->toArray();

		$data['models'] = DB::table('ram_model')
		    					->where('RAM_MOD_FLG','Active')
		    					->get()
		    					->toArray();

		$data['branch'] = DB::table('ram_branch')
								->select('RAM_BRANCH_ID','LSO_OFFICE_NAME_C')
		    					->get()
		    					->toArray();

		$data['segment'] = DB::table('customer_segment')
								->select('name')
		    					->get()
		    					->toArray();    					

		$data['values'] = DB::table('ram_value')
		    					->where('RAM_LOV_FLG','Active')
		    					->get()
		    					->toArray();

    	

        return view('models.add',$data);   	
 
    }

   	public function edit(Request $request)
   	{

   		$custID = $request->input('custId');
   		$data['items'] = DB::table('ram_category')
		    					->where('RAM_CAT_LOV_FLG', 'No')
		    					->orderBy('RAM_ORDER_NO','asc')
		    					->limit(7)
		    					->get()
		    					->toArray();

		$data['models'] = DB::table('ram_model')
		    					->where('RAM_MOD_FLG','Active')
		    					->get()
		    					->toArray();

		$data['userDetails'] = DB::table('ram_tran_header')
		    					->where('CUST_ID',$custID)		    					
		    					->first();    					
		
		
		$data['branch'] = DB::table('ram_branch')
								->select('RAM_BRANCH_ID','LSO_OFFICE_NAME_C')
		    					->get()
		    					->toArray();

		$data['segment'] = DB::table('customer_segment')
								->select('name')
		    					->get()
		    					->toArray();  

        return view('models.edit',$data); 
    	//return view('summary.getdata',$result); 

   	}
   	public function save(Request $request)
   	{
   		
   		//echo"<pre>";print_r($request->all());die;
   		$customerId = '';
		$summaryId = uniqid();

   		if($request->has('customerId'))
   		{
   			$customerId = $request->customerId;
   			$summaryId = $request->summaryId;
   			$version = (int)$request->version;
   		}

   		// dd($version);
   		$customerName 	= $request->cust_name; 
		$fanNo 			= $request->fan_no;
		$panNo 			= $request->pan_no;
		$type 			= $request->type;
		$company 		= $request->company;
		$branch			= $request->branch;
		$custSegment	= $request->custseg;
		$createdDate = date('Y-m-d');
		
		$typeMaster = DB::table('ram_model')
					->select('RAM_MOD_DESC')
					->where(['RAM_MOD_ID' => $type])
					->first();

		$branchMaster = DB::table('ram_branch')
					->select('LSO_OFFICE_NAME_C')
					->where(['RAM_BRANCH_ID' => $branch])
					->first();			

		
		
		$questions = DB::table('ram_category')
					->select('RAM_CAT_QUESTION_ID','RAM_CAT_QUESTION_SHORT_DESC','RAM_CAT_QUESTION_LONG_DESC','RAM_MAX_WEIGHTAGE','RAM_CAT_DESC')
					->where(['RAM_CAT_LOV_FLG' => 'Yes','RAM_CAT_MOD_ID' => $type])
					->get();

		$excelDate = date('d-m-Y');
		$custArray = ['CustomerName' => $request->cust_name,'FANNO' => $request->fan_no,'PANNO' => $request->pan_no,'Type' => $typeMaster->RAM_MOD_DESC,'Company' => $request->company,'Branch' => $branchMaster->LSO_OFFICE_NAME_C,'CustomerSegment' => $custSegment,'excel_date' =>$excelDate];			
		$arr = [];
		foreach ($questions as $keyIndex => $question) 
		{
			$mainCategory = $question->RAM_CAT_QUESTION_ID;
			//dd($request['category_'.$mainCategory]);
			if($request['category_'.$mainCategory] != '')
			{
				
				$categoryDetails = DB::table('ram_category')
									->select('RAM_CAT_UNQ_CODE')
									->where(['RAM_CAT_QUESTION_ID'=>$question->RAM_CAT_QUESTION_ID , 'RAM_CAT_FLG' => 'Active'])
									->first();
			    $categoryCode = $categoryDetails->RAM_CAT_UNQ_CODE;			
				$value = DB::table('ram_value')
						->select('RAM_LOV_ID','RAM_LOV_DESC','RAM_LOV_Weightage','RAM_LOV_CAT_CODE')
						->where(['RAM_LOV_QUEST_ID'=>$question->RAM_CAT_QUESTION_ID,'RAM_LOV_ID' => $request['category_'.$mainCategory] , 'RAM_LOV_FLG' => 'Active'])
						->first();
				
				//dd($value);
				$uuid = Str::uuid();
				if($value != null)
				{
					
					$lovId = $value->RAM_LOV_ID;
					$weightage = $value->RAM_LOV_Weightage;
					$arr[$question->RAM_CAT_DESC.'_'.$keyIndex] = array("question"=>$question->RAM_CAT_QUESTION_SHORT_DESC,"explanation" =>$question->RAM_CAT_QUESTION_LONG_DESC,"anwser"=> $value->RAM_LOV_DESC,'max-weight' =>$question->RAM_MAX_WEIGHTAGE ,'actual-weight' => $weightage);

					$dataInsert =array('RAM_TRAN_ID' => $uuid ,'RAM_SUMMARY_ID'=>$summaryId,"RAM_TRAN_MOD_ID"=>$type,"RAM_TRAN_CAT_CODE" =>$categoryCode ,"RAM_TRAN_LOV_ID"=>$lovId,"RAM_TRAN_LOV_Weightage_ID"=>$weightage,'RAM_TRAN_CRT_DT' => $createdDate);
					if(!empty($customerId))
					{
						$transDetails = DB::table('ram_tran')
								->where(['RAM_SUMMARY_ID' => $summaryId,'RAM_TRAN_CAT_CODE' => $categoryCode])		    					
		    					->first();

		    			if(!empty($transDetails))	
		    			{

		    				$dataUpdate =array("RAM_TRAN_CAT_CODE" =>$categoryCode ,"RAM_TRAN_LOV_ID"=>$lovId,"RAM_TRAN_LOV_Weightage_ID"=>$weightage,'RAM_TRAN_MOD_DT' => $createdDate);
		    				
		    				// dd($dataUpdate);
		    				DB::table('ram_tran')->where(['RAM_SUMMARY_ID' =>$summaryId,'RAM_TRAN_CAT_CODE' => $categoryCode,'RAM_TRAN_MOD_ID' => $type ])->update($dataUpdate);
		    			}
						
					}
					else
					{
						
						DB::table('ram_tran')->insert($dataInsert);						
					}
				}
				else
				{
					$categoryDetails = DB::table('ram_category')
									->select('RAM_CAT_UNQ_CODE')
									->where(['RAM_CAT_QUESTION_ID'=>$question->RAM_CAT_QUESTION_ID , 'RAM_CAT_FLG' => 'Active'])
									->first();

					$categoryCode = $categoryDetails->RAM_CAT_UNQ_CODE;

					$arr[$question->RAM_CAT_DESC.'_'.$keyIndex] = array("question"=>$question->RAM_CAT_QUESTION_SHORT_DESC,"explanation" =>$question->RAM_CAT_QUESTION_LONG_DESC,"anwser"=> $request['category_'.$mainCategory],'max-weight' =>'' ,'actual-weight' => '');

					$withouLOVIDInsert =array('RAM_TRAN_ID' => $uuid ,'RAM_SUMMARY_ID'=>$summaryId,"RAM_TRAN_MOD_ID"=>$type,"RAM_TRAN_CAT_CODE" =>$categoryCode ,"RAM_TRAN_LOV_ID"=>NULL,"RAM_TRAN_LOV_Weightage_ID"=>$request['category_'.$mainCategory],'RAM_TRAN_MOD_DT' => $createdDate);
					if(!empty($customerId))
					{
						$withouLOVIDUpdate =array('RAM_SUMMARY_ID'=>$summaryId,"RAM_TRAN_MOD_ID"=>$type,"RAM_TRAN_CAT_CODE" =>$categoryCode ,"RAM_TRAN_LOV_ID"=>NULL,"RAM_TRAN_LOV_Weightage_ID"=>$request['category_'.$mainCategory],'RAM_TRAN_MOD_DT' => $createdDate);
						DB::table('ram_tran')->where(['RAM_SUMMARY_ID' =>$summaryId,'RAM_TRAN_CAT_CODE' => $categoryCode,'RAM_TRAN_MOD_ID' => $type ])
											->whereNull('RAM_TRAN_LOV_ID')
											->update($withouLOVIDUpdate);
					}
					else
					{					
						
						DB::table('ram_tran')->insert($withouLOVIDInsert);
					}
				}
					
			}	

		}			
		if(!empty($customerId))
		{
			$version = $version +1;
			$custData=array('RAM_TRAN_SUMMARY_ID'=>$summaryId,"CUST_NAME"=>$customerName,"FAN_NO"=>$fanNo,"PAN_NO"=>$panNo,"TYPE"=>$type,"COMPANY"=>$company,"BRANCH"=>$branch,"CUST_SEGMENT" =>$custSegment,"RAM_VERSION"=> $version,'RAM_TRAN_HEADER_MOD_DT' => $createdDate);
			DB::table('ram_tran_header')->where(['RAM_TRAN_SUMMARY_ID' =>$summaryId ])->update($custData);
			
		}
		else
		{
			$custId = rand(10,100);
			$version = 1;
			$custData=array('RAM_TRAN_SUMMARY_ID'=>$summaryId,"CUST_ID" => $custId , "CUST_NAME"=>$customerName,"FAN_NO"=>$fanNo,"PAN_NO"=>$panNo,"TYPE"=>$type,"COMPANY"=>$company,"BRANCH"=>$branch,"CUST_SEGMENT" =>$custSegment,"RAM_VERSION"=> $version,'RAM_TRAN_HEADER_CRT_DT' => $createdDate);
			DB::table('ram_tran_header')->insert($custData);
			
		}
		$this->getSpreedsheetData($summaryId,$panNo,$version,$arr,$type,$custArray);
		return redirect()->action('SummaryController@getdata',['summaryID'=>$summaryId]);
		
   	}

   	public function getSpreedsheetData($summaryId,$panNo,$version,$array,$typeId,$custArray)
   	{
   		$riskTypes = DB::table('ram_tran')
						->select('ram_category.RAM_CAT_DESC as name','ram_category.RAM_MAX_WEIGHTAGE as weight', DB::raw('SUM(ram_tran.RAM_TRAN_LOV_Weightage_ID) as data'))
						->join('ram_category','ram_category.RAM_CAT_UNQ_CODE','=','ram_tran.RAM_TRAN_CAT_CODE')
						->orderBy('ram_category.RAM_CAT_ORDER_QUESTION')
						->groupBy('ram_category.RAM_CAT_DESC')
						->where(['ram_tran.RAM_SUMMARY_ID' => $summaryId])
						->whereNotNull('ram_tran.RAM_TRAN_LOV_ID')
						->get()->toArray();
		//echo"<pre>";print_r(json_decode(json_encode($riskTypes),true));die;
		$risktype = json_decode(json_encode($riskTypes),true);
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('C1', 'Risk Type');
		$sheet->setCellValue('D1', 'Maximum Wt');
		$sheet->setCellValue('E1', 'Actual Score');

		$borderArray = 
                [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ]
                ];
                

		$sheet ->getStyle('E1:G1')->applyFromArray($borderArray);

		$maxWeight=0;
		$actualScore =0;
		for ($i=0; $i < count($risktype) ; $i++) 
		{ 
			$k=$i+2;
			$sheet->setCellValue('C'.$k, $risktype[$i]['name']);
			$sheet->setCellValue('D'.$k, $risktype[$i]['weight']);
			$sheet->setCellValue('E'.$k, $risktype[$i]['data']);

			$maxWeight = $maxWeight + $risktype[$i]['weight'];
			$actualScore = $actualScore + $risktype[$i]['data'];

			if($i == count($risktype) -1)
			{
				$j = $k+1;
				$sheet->setCellValue('C'.$j, 'Total Score');
				$sheet->setCellValue('D'.$j, $maxWeight);
				$sheet->setCellValue('E'.$j, $actualScore);

				$sheet ->getStyle('E2:G'.$j)->applyFromArray($borderArray);
			}
			
		}

		$ramModel = DB::table('ram_model')
					->select('RAM_MOD_DESC')
					->where(['RAM_MOD_ID'=>$typeId])
					->first();

		// Header
		//$sheet->mergeCells("A1:B1");
		$sheet->setCellValue('B1', 'Risk Assessment Model 2020 Ver. '.$version.'.0 [RAM] '.$ramModel->RAM_MOD_DESC);
		

		// Customer Info
		$sheet->setCellValue('A2', 'Borrower Name');
		$sheet->setCellValue('A5', 'Branch, State');
		$sheet->setCellValue('A7', 'Date(DDMMYYYY)');

		$sheet->setCellValue('B2', $custArray['CustomerName']);
		$sheet->setCellValue('B5', $custArray['Branch']);
		$sheet->setCellValue('B7', $custArray['excel_date']);
		

		$sheet ->getStyle('A2:B7')->applyFromArray($borderArray);

		// Customer Info End
		$questions = DB::table('ram_category')
					->select('RAM_CAT_DESC')
					->where(['RAM_CAT_LOV_FLG' => 'Yes','RAM_CAT_MOD_ID'=>$typeId])
					->orderBy('RAM_CAT_ORDER_QUESTION')
					->groupBy('RAM_CAT_DESC')
					->get();

		$sheet->setCellValue('A12', 'Risk Category');
		$sheet->setCellValue('B12', 'Variables');
		$sheet->setCellValue('C12', 'Brief Explanation');
		$sheet->setCellValue('D12', 'Best Fit option to be selected');
		$sheet->setCellValue('E12', 'Actual Score');
		$sheet->setCellValue('F12', 'Max Score');
		$sheet->getStyle('A12:F12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('A4A4A4');
		//$sheet->getStyle('A12:F12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A12:F12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7030A0');
		$sheet->getStyle('A12:F12')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
		$sheet->getStyle('A1:G1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
		$sheet->getRowDimension('1')->setRowHeight(30);
		$sheet->getRowDimension('12')->setRowHeight(30);
		$n=13;
		$m = 0;
		$catName ='';
		$mergeRange = '';
		$secindMergeRange = '';
		$checkCategory = '';
		$lastRange= 0;
		$flag = 0;
		foreach($array as $key => $value) 
		{ 
			
			$indexVal = explode("_", $key);
			$mainCat = $indexVal[0];

			// if($mainCat != $checkCategory)
			// {
			// 	$flag = 1;
			// }
			foreach ($questions as  $question) 
			{
				
				$category = $question->RAM_CAT_DESC.'_'.$m;
				$expArray = explode("_", $category);
				$actualCategory = $expArray[0];
				//print_r($category);die;
				if($mainCat == $actualCategory)
				{	

					if($actualCategory != $catName)
					{
						$sheet->setCellValue('A'.$n, $actualCategory);
						$mergeRange = 'A'.$n;

					}
					else
					{
						$o =$n-1;
						//$sheet->mergeCells('A'.$o.':A'.$n);
					}
					$sheet->setCellValue('B'.$n, $value['question']);
					$sheet->setCellValue('C'.$n, $value['explanation']);
					$sheet->setCellValue('D'.$n, $value['anwser']);
					$sheet->setCellValue('E'.$n, $value['actual-weight']);
					$sheet->setCellValue('F'.$n, $value['max-weight']);

					$catName = $actualCategory;
				}
			}

			$n = $n +1;
			$m = $m +1;
			$checkCategory = $mainCat;
			$lastRange = $indexVal[1];
		}
		$sheet ->getStyle('A12:F'.$lastRange)->applyFromArray($borderArray);


		$writer = new Xlsx($spreadsheet);
		$writer->save('upload/excel/'.$panNo.'_'.$version.'.xlsx');
		//die;
		return 1;
   	}

    public function getVariables(Request $request)
    {
    	$typeID = $request['typeId'];
    	//$typeID = '31c716aa-9';

    	$quetions = DB::table('ram_category')
					->select('RAM_CAT_DESC')
					->where(['RAM_CAT_LOV_FLG' => 'Yes','RAM_CAT_MOD_ID'=>$typeID])
					->orderBy('RAM_CAT_ORDER_QUESTION')
					//->orderByRaw("CASE WHEN RAM_CAT_ORDER_QUESTION IS NULL THEN 0 END ASC")
					->groupBy('RAM_CAT_DESC')
					->get();
					// echo"<pre>";print_r($quetions);die;
			//dd($quetions);

		$data['variablesNvalues'] = array();

		foreach ($quetions as $quetion) {										
		$variables = DB::table('ram_category')
		            ->select('ram_category.RAM_CAT_QUESTION_ID',
		            	'ram_category.RAM_CAT_QUESTION_SHORT_DESC',
		            	'ram_category.RAM_CAT_QUESTION_LONG_DESC',
		            	'ram_category.RAM_CAT_DESC',
		            	'ram_category.RAM_CAT_ORDER_QUESTION',
		            	'ram_category.RAM_CAT_MOD_ID'	        	)
		        	->where(['RAM_CAT_MOD_ID'=>$typeID,'RAM_CAT_DESC' => $quetion->RAM_CAT_DESC ])
		            ->orderBy('RAM_CAT_ORDER_QUESTION')
		            //->orderByRaw("CASE WHEN RAM_CAT_ORDER_QUESTION IS NULL THEN 0 END DESC")
		            ->get();


		
		foreach ($variables as $key => $variable) {
			$values['RAM_VALUE'] = $this->getValues($variable->RAM_CAT_QUESTION_ID);
			$values['RAM_CAT_QUESTION_SHORT_DESC'] =$variable->RAM_CAT_QUESTION_SHORT_DESC;
			$values['RAM_CAT_QUESTION_LONG_DESC'] = $variable->RAM_CAT_QUESTION_LONG_DESC;
			$values['RAM_CAT_DESC'] = $variable->RAM_CAT_DESC;
			$values['RAM_CAT_QUESTION_ID'] = $variable->RAM_CAT_QUESTION_ID;
			$values['RAM_CAT_MOD_ID'] = $variable->RAM_CAT_MOD_ID;
			if(!empty($values))
			{
				array_push($data['variablesNvalues'], $values);
			}
		}
	}

    	return view('components.variables', $data);
    }

    public function getDownload(Request $request)
	{
	    //PDF file is stored under project/public/download/info.pdf
	    //$file= "http://172.26.101.15/ram/upload/pdf/blank.pdf";
	    $panNo = $request->input('pan_no');
	    $version = $request->input('version');
		$filePath = public_path("upload/pdf/blank.pdf");
        $headers = ['Content-Type: application/pdf'];
        $fileName = $panNo.'_'.$version.'.pdf';
        return response()->download($filePath, $fileName, $headers);
	    
	}

	public function downloadexcel(Request $request)
	{
	    //PDF file is stored under project/public/download/info.pdf
	    //$file= "http://172.26.101.15/ram/upload/pdf/blank.pdf";
	    $panNo = $request->input('pan_no');
	    $version = $request->input('version');
		$filePath = public_path("upload/excel/".$panNo.'_'.$version.".xlsx");
        $headers = ['Content-Type: application/pdf'];
        $fileName = $panNo.'_'.$version.'.xlsx';
        return response()->download($filePath, $fileName, $headers);
	    
	}


    public function cleanData(&$str)
	  {
	    $str = preg_replace("/\t/", "\\t", $str);
	    $str = preg_replace("/\r?\n/", "\\n", $str);
	    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	  }

    // public function downloadExcel($dataArray,$version,$panNo)
    // {

    // 	$filename = $panNo . date('Ymd') ."_".$version. ".xls";

		  // // header("Content-Disposition: attachment; filename=\"$filename\"");
		  // // header("Content-Type: application/vnd.ms-excel");
		  // 	// var_dump($dataArray);

		  // $flag = false;
		  // foreach($dataArray as $row) {
		  // 	var_dump($row);
		  //   if(!$flag) {
		  //     // display field/column names as first row
		  //     echo implode("\t", array_keys($row)) . "\r\n";
		  //     $flag = true;
		  //   }
		  //   // array_walk($row, __NAMESPACE__ . '\cleanData');
		  //   array_walk($row, __NAMESPACE__ . '\cleanData');
		  //   echo implode("\t", array_values($row)) . "\r\n";
		  // }
		  // // exit;
    // }

    public function editgetVariables(Request $request)
    {
    	
    	$custID = $request['custId'];

    	$data['userDetails'] = DB::table('ram_tran_header')
		    					->where('CUST_ID',$custID)		    					
		    					->first();
		$typeID =   $data['userDetails']->TYPE;

    	$quetions = DB::table('ram_category')
					->select('RAM_CAT_DESC')
					->where(['RAM_CAT_LOV_FLG' => 'Yes','RAM_CAT_MOD_ID' => $typeID])
					->orderBy('RAM_CAT_ORDER_QUESTION')
					->groupBy('RAM_CAT_DESC')
					->get();

			//dd($quetions);
		  

		$data['tranDetails'] = DB::table('ram_tran')
								->select('ram_tran.RAM_TRAN_LOV_ID','ram_category.RAM_CAT_UNQ_CODE','ram_category.RAM_CAT_QUESTION_SHORT_DESC','ram_tran.RAM_TRAN_LOV_Weightage_ID')
								->join('ram_category','ram_category.RAM_CAT_UNQ_CODE','=','ram_tran.RAM_TRAN_CAT_CODE')
								//->join('ram_value','ram_value.RAM_LOV_ID','=','ram_tran.RAM_TRAN_LOV_ID')								
		    					->where('ram_tran.RAM_SUMMARY_ID','=',$data['userDetails']->RAM_TRAN_SUMMARY_ID)		    					
		    					->get();
		    					//dd($data['tranDetails']);
		$data['scoreval'] = DB::table('ram_tran')
						->select('ram_category.RAM_CAT_DESC', DB::raw('SUM(ram_tran.RAM_TRAN_LOV_Weightage_ID) as total'))
						->join('ram_category','ram_category.RAM_CAT_UNQ_CODE','=','ram_tran.RAM_TRAN_CAT_CODE')
						->groupBy('ram_category.RAM_CAT_DESC')
						->where(['ram_tran.RAM_SUMMARY_ID' => $data['userDetails']->RAM_TRAN_SUMMARY_ID ])
						->whereNotNull('ram_tran.RAM_TRAN_LOV_ID')
						->get();
						    					
		    // dd($data['tranDetails']);

		$data['variablesNvalues'] = array();

		foreach ($quetions as $quetion) {										
		$variables = DB::table('ram_category')
		            ->select('ram_category.RAM_CAT_QUESTION_ID',
		            	'ram_category.RAM_CAT_QUESTION_SHORT_DESC',
		            	'ram_category.RAM_CAT_QUESTION_LONG_DESC',
		            	'RAM_CAT_ORDER_QUESTION',
		            	'ram_category.RAM_CAT_DESC',
		            	'ram_category.RAM_CAT_MOD_ID'
		        	)
		        	->where(['RAM_CAT_MOD_ID'=>$typeID,'RAM_CAT_DESC' => $quetion->RAM_CAT_DESC ])
		            ->orderBy('RAM_CAT_ORDER_QUESTION')
		            ->get();


		
		foreach ($variables as $key => $variable) {
			$values['RAM_VALUE'] = $this->getValues($variable->RAM_CAT_QUESTION_ID);
			$values['RAM_CAT_QUESTION_SHORT_DESC'] =$variable->RAM_CAT_QUESTION_SHORT_DESC;
			$values['RAM_CAT_QUESTION_LONG_DESC'] = $variable->RAM_CAT_QUESTION_LONG_DESC;
			$values['RAM_CAT_DESC'] = $variable->RAM_CAT_DESC;
			$values['RAM_CAT_QUESTION_ID'] = $variable->RAM_CAT_QUESTION_ID;
			$values['RAM_CAT_MOD_ID'] = $variable->RAM_CAT_MOD_ID;
			
			if(!empty($values))
			{
				array_push($data['variablesNvalues'], $values);
			}
		}
	}

    	return view('components.editvariables', $data);
    }

    public function getValues($queID)
    {
    	// $typeID = $request['type_id'];
    	$values = NULL;

    	try {

    	// $queID = '127e43ed-9';

		$values = DB::table('ram_value')
					->select('RAM_LOV_ID','RAM_LOV_DESC','RAM_LOV_Weightage')
					->where(['RAM_LOV_QUEST_ID'=>$queID,'RAM_LOV_FLG' => 'Active'])
					->get();
    		
    	} catch (Exception $e) {
    		$values = NULL;
    	}

    	return $values;
    }

    public function calcScore()
    {
    	$data = "";

    	return $data;
    }
}