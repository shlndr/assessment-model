<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;


class SummaryController extends Controller
{
	
	public function index(Request $request)
    {
		// dd($request->all());
		$customerName 	= $request->cust_name; 
		$fanNo 			= $request->fan_no;
		$panNo 			= $request->pan_no;
		$type 			= $request->type;
		$company 		= $request->company;
		$branch			= $request->branch;
		$custSegment	= $request->custseg;

		
		$questions = DB::table('ram_category')
					->select('RAM_CAT_QUESTION_ID')
					->where(['RAM_CAT_LOV_FLG' => 'Yes','RAM_CAT_MOD_ID' => $type])
					->get();
		$category = 'category_';
		$summaryId = uniqid();
		// dd($questions);
		foreach ($questions as $question) 
		{
			$mainCategory = $category.$question->RAM_CAT_QUESTION_ID;
			//dd($mainCategory);
			if($request->$mainCategory  != null)
			{
				//dd("hello");
				$values = DB::table('ram_value')
						->select('RAM_LOV_ID','RAM_LOV_DESC','RAM_LOV_Weightage','RAM_LOV_CAT_CODE')
						->where(['RAM_LOV_QUEST_ID'=>$question->RAM_CAT_QUESTION_ID,'RAM_LOV_FLG' => 'Active'])
						->get();
				// dd($values);
				foreach ($values as $value) 
				{
					$categoryCode = $value->RAM_LOV_CAT_CODE;
					$lovId = $value->RAM_LOV_ID;
					$weightage = $value->RAM_LOV_Weightage;
					$createdDate = date('Y-m-d');
					$uuid = Str::uuid();
					$uuid = substr($uuid,0,9);
					$dataInsert =array('RAM_TRAN_ID' => $uuid ,'RAM_SUMMARY_ID'=>$summaryId,"RAM_TRAN_MOD_ID"=>$type,"RAM_TRAN_CAT_CODE" =>$categoryCode ,"RAM_TRAN_LOV_ID"=>$lovId,"RAM_TRAN_LOV_Weightage_ID"=>$weightage,'RAM_TRAN_CRT_DT' => $createdDate);
					DB::table('ram_tran')->insert($dataInsert);
				}		
			}	

		}			
		

		$custData=array('RAM_TRAN_SUMMARY_ID'=>$summaryId,"CUST_NAME"=>$customerName,"FAN_NO"=>$fanNo,"PAN_NO"=>$panNo,"TYPE"=>$type,"COMPANY"=>$company,"BRANCH"=>$branch,"CUST_SEGMENT" =>$custSegment,"RAM_VERSION"=> '1','RAM_TRAN_HEADER_CRT_DT' => $createdDate);
		DB::table('ram_tran_header')->insert($custData);
    }

    public function getRationale(Request $request)
    {
    	$rationale = $request->rationale;
   		$summaryId = $request->summaryId;
   		if(!empty($summaryId))
   		{
   			$data['userDetails'] = DB::table('ram_tran_header')
		    					->where('RAM_TRAN_SUMMARY_ID',$summaryId)		    					
		    					->first();
		    if(!empty($data['userDetails']))
		    {				
			    $dataUpdate =array("RATIONALE" =>$rationale);
			    DB::table('ram_tran_header')->where(['RAM_TRAN_SUMMARY_ID' =>$summaryId])->update($dataUpdate);
			}
   		}
   		return redirect()->action('ModelController@index');
    }

    public function getdata(Request $request)
    {
    	
    	$summaryId = $request->input('summaryID');
    	$result['data'] = DB::table('ram_tran')
						->select('ram_category.RAM_CAT_DESC as name','ram_category.RAM_MAX_WEIGHTAGE as weight', DB::raw('SUM(ram_tran.RAM_TRAN_LOV_Weightage_ID) as data'))
						->join('ram_category','ram_category.RAM_CAT_UNQ_CODE','=','ram_tran.RAM_TRAN_CAT_CODE')
						->orderBy('ram_category.RAM_CAT_ORDER_QUESTION')
						->groupBy('ram_category.RAM_CAT_DESC')
						->where(['ram_tran.RAM_SUMMARY_ID' => $summaryId])
						->whereNotNull('ram_tran.RAM_TRAN_LOV_ID')
						->get();
						//dd($result['data']);
		$result['summaryId'] = $summaryId;				

		//dd(json_encode($result['data']));			
    	return view('summary.getdata',$result); 
    }

    
    public function generatePdf(Request $request)
    {

    	   		$custID = $request->input('custId');
    	   		// $data['summaryId'] = $request->input('summaryId');
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
    									->select('ram_tran_header.CUST_NAME','ram_branch.LSO_OFFICE_NAME_C','ram_branch.REGION','ram_tran_header.RAM_TRAN_HEADER_CRT_DT','ram_model.RAM_MOD_DESC','ram_tran_header.RAM_TRAN_SUMMARY_ID','ram_tran_header.RATIONALE','ram_tran_header.PAN_NO','ram_tran_header.RAM_VERSION')
    									->join('ram_branch','ram_branch.ram_branch_id','=','ram_tran_header.BRANCH')
    									->join('ram_model','ram_model.RAM_MOD_ID','=','ram_tran_header.TYPE')
    			    					->where('ram_tran_header.CUST_ID',$custID)		    					
    			    					->first(); 		

    			if(!empty($data['userDetails']->RAM_TRAN_SUMMARY_ID))
    			{

    	   		$data['ram_tran'] = DB::table('ram_tran')
    	   						->select('ram_category.RAM_CAT_DESC','ram_category.RAM_CAT_QUESTION_SHORT_DESC','ram_value.RAM_LOV_DESC','ram_value.RAM_LOV_Weightage')
    	   						->join('ram_category','ram_category.RAM_CAT_UNQ_CODE','=','ram_tran.RAM_TRAN_CAT_CODE')
    	   						->join('ram_value','ram_value.RAM_LOV_ID','=','ram_tran.RAM_TRAN_LOV_ID')
		    					->where('ram_tran.RAM_SUMMARY_ID', $data['userDetails']->RAM_TRAN_SUMMARY_ID)
		    					->orderBy('RAM_ORDER_NO','asc')
		    					->get()
		    					->toArray();
    			}else{
    				$data['ram_tran'] = array();
    			}
    			
    			$data['branch'] = DB::table('ram_branch')
    									->select('RAM_BRANCH_ID','LSO_OFFICE_NAME_C')
    			    					->get()
    			    					->toArray();

    			$data['segment'] = DB::table('customer_segment')
    									->select('name')
    			    					->get()
    			    					->toArray();  
// var_dump($data['ram_tran']);die();
		$pdf = \App::make('dompdf.wrapper');
		// var_dump($this->convert_customer_data_to_html($data['summaryId']));die();
	    $pdf->loadHTML($this->convert_customer_data_to_html($data));
	    return $pdf->download();
    	// return view('summary.genpdf',$data);
    }

    public function convert_customer_data_to_html($data)
    {
    	$output = '
  <style>
.table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.table td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

.table tr:nth-child(even){background-color: #f2f2f2;}

.table tr:hover {background-color: #ddd;}

.table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<div style="width:100%;margin: 0 auto;">
<div style="background: #8A1695;height: 60px;width: 100%;padding:0 10px;">
	<img src="http://127.0.0.1/ram/public/img/brand/white.png" style="width: 200px;margin-top:10px;margin-right: 100px;">
	<span style="float:right;font-size: 12px;color: #fff;margin-top: -10px;"><h1>Risk Assessment Model</h1></span>
</div>


<table style="width: 100%;margin-top:10px;" class="table">
  <tr>
      <td>Customer Name:</td>
      <td>'.$data['userDetails']->CUST_NAME.'</td>
   </tr>
   <tr>
      <td>Branch, State</td>
      <td>'.$data['userDetails']->LSO_OFFICE_NAME_C.', '.$data['userDetails']->REGION.'</td>
   </tr>
   <tr>
      <td>Date:</td>
      <td>'.$data['userDetails']->RAM_TRAN_HEADER_CRT_DT.'</td>
   </tr>
   <tr>
      <td>Type:</td>
      <td>'.$data['userDetails']->RAM_MOD_DESC.'</td>
   </tr>
</table>
<div style="margin-top: 10px;border:1px solid grey;height:450px;">
<img src="http://127.0.0.1/ram/public/upload/images/'.$data['userDetails']->RAM_TRAN_SUMMARY_ID.'-meter.jpeg" style="width: 48%;display: inline-block;">
<img src="http://127.0.0.1/ram/public/upload/images/'.$data['userDetails']->RAM_TRAN_SUMMARY_ID.'-table.jpeg" style="width: 48%;display: inline-block;margin-top:60px;">
</div>
<div>
<p><b>Rationale for Score</b></p>
<p>'.$data['userDetails']->RATIONALE.'</p>
</div>

<table style="width: 100%;margin-top: 20px;"  class="table">
	<tr>
	<td>Variable</td>
	<td>Value</td>
	<td>Score</td>
	</tr>';

$RAM_CAT_DESC = "";
$i=0;
$totalWeight = 0;
foreach ($data['ram_tran'] as $key => $value) {
	if($RAM_CAT_DESC != $value->RAM_CAT_DESC)
	{
	$i = $i +1;
	$RAM_CAT_DESC = $value->RAM_CAT_DESC;
	$data['scoreval'] = DB::table('ram_tran')
				->select('ram_category.RAM_CAT_DESC', DB::raw('SUM(ram_tran.RAM_TRAN_LOV_Weightage_ID) as total'))
				->join('ram_category','ram_category.RAM_CAT_UNQ_CODE','=','ram_tran.RAM_TRAN_CAT_CODE')
				->groupBy('ram_category.RAM_CAT_DESC')
				->where(['ram_tran.RAM_SUMMARY_ID' => $data['userDetails']->RAM_TRAN_SUMMARY_ID ])
				->whereNotNull('ram_tran.RAM_TRAN_LOV_ID')
				->get();
		   foreach($data['scoreval'] as $scores){
		   if($scores->RAM_CAT_DESC == $RAM_CAT_DESC)
		   {
		   	$output .=	'
		   			<tr>
		   		      <td colspan="2"><b>'.$RAM_CAT_DESC.'</b></td>
		   		      <td style="text-align:center;"><b><span>'.$scores->total.'</span></b></td>
		   		   </tr>';
		   	$totalWeight = $totalWeight + $scores->total;
		   }
		   }
	}else{

	}
		$output .= '
		   <tr>
		      <td>'.$value->RAM_CAT_QUESTION_SHORT_DESC.'</td>
		      <td>'.$value->RAM_LOV_DESC.'</td>
		      <td style="text-align:center;">'.$value->RAM_LOV_Weightage.'</td>
		   </tr>
		   ';

}


   $output .= '

   	<tr>
         <td colspan="2"><b>Total score out of 100</b></td>
         <td style="text-align:center;"><b>'.$totalWeight.'</span></b></td>
      </tr>
</table>
</div>
    	 ';
    	     return $output;
    }

    public function loadImage()
    {
    $img = $_POST['imgBase64'];  
    $summaryId = $_POST['summaryId'];  
    $type = $_POST['type'];  
      $img = str_replace('data:image/jpeg;base64,', '', $img);  
      $img = str_replace(' ', '+', $img);  
      $data = base64_decode($img);  
      $file = public_path('upload/images/') . $summaryId .'-'. $type . '.jpeg';  
      $success = file_put_contents($file, $data);  
      return $success ? $file : 'Unable to save the file.';
    }
}