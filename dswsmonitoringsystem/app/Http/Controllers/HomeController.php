<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use PDF;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getTables(){
        $records = DB::table('reportedfireincidents')->get();
        return view('firedata')->with('records',$records);
    }

    public function getVictimsData(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('victimsdata')
        ->with('records',$records)
        ->with('info',$info);
    }

    public function getMoreInfo(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('victimsdata-more-info')
        ->with('records',$records)
        ->with('info',$info);
    }

    public function getMoreInfoSocialWork(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('victims-more-info-socialwork')
        ->with('records',$records)
        ->with('info',$info);
    }


    public function getFinalList(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('final-list')
        ->with('records',$records)
        ->with('info',$info);
    }

    public function getEditList(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('editdata')
        ->with('records',$records)
        ->with('info',$info);
    }

    public function getVerifiedList(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->where('verified', 'Yes')->get();
        return view('verifiedlist')
        ->with('records',$records)
        ->with('info',$info);
    }

    public function getAssistanceSummary(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('Assistance')
        ->with('records',$records)
        ->with('info',$info);
    }

    function getFireData($code)
    {
      $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
      return $records;
    }


    function getVicData($code)
    {
      $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->get();
      return $victimsdata;
    }

    function getVicDataVerified($code)
    {
      $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('verified', 'Yes')->get();
      return $victimsdata;
    }

    function pdf(Request $request)
    {
      $code = $request->input('codename');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper('legal', 'portrait');
      $pdf->loadHTML($this->convert_victimsdata_to_html($code));
      return $pdf->stream();
    }

    function convert_victimsdata_to_html($code)
    {
     $victimsdata = $this->getVicData($code);
     $records = $this->getFireData($code);
     $number = 0;
     foreach ($records as $firedata) {
       $output = '
       <img src="'. public_path() .'/img/dsws.png" style= "width: 30; height: 30; margin: 0; margin-top: 18px; margin-left: 140px; padding: 0; position: fixed;"/>

       <h5 align="center" style="margin: 0; padding: 0; margin-top: 20px; font-family: Tahoma, Geneva, sans-serif">DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h5>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">DSWS Bldg., Katipunan St., Cebu City, 6000 Cebu</p>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">(02) 269 9350</p>
       <br>
       <h4 align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Baranggay.', '.$firedata->Municipality.' Fire Victims</h4>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Date.', '.$firedata->Time.'</p>
       <p align="center" style="margin: 0; padding: 0;font-family: Tahoma, Geneva, sans-serif">'.$firedata->Sitio.', '.$firedata->Baranggay.', '.$firedata->Municipality.', '.$firedata->Province.'</p>
       <br>';
     }
     $output .= '
       <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
      <th style="border: 1px solid; padding:12px;" width="10%">#</th>
      <th style="border: 1px solid; padding:12px;" width="30%">Name</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Validated</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Resident Category</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Date</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Signature</th>
     </tr>
       ';

     foreach($victimsdata as $customer)
     {
      $number = $number + 1;
      $output .= '
      <tr  style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
       <td style="border: 1px solid; padding:12px;">'.$number.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->lastname.', '.$customer->firstname.' '.$customer->middlename.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->verified.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->residentCategory.'</td>
       <td style="border: 1px solid; padding:12px;"></td>
       <td style="border: 1px solid; padding:12px;"></td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

    function unverifiedPdf(Request $request)
    {
      $code = $request->input('codename');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper('legal', 'portrait');
      $pdf->loadHTML($this->convert_unverifiedlist_to_html($code));
      return $pdf->stream();
    }

    function convert_unverifiedlist_to_html($code)
    {
     $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('verified', 'No')->get();
     $records = $this->getFireData($code);
     $number = 0;
     foreach ($records as $firedata) {
       $output = '
       <img src="'. public_path() .'/img/dsws.png" style= "width: 30; height: 30; margin: 0; margin-top: 18px; margin-left: 140px; padding: 0; position: fixed;"/>

       <h5 align="center" style="margin: 0; padding: 0; margin-top: 20px; font-family: Tahoma, Geneva, sans-serif">DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h5>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">DSWS Bldg., Katipunan St., Cebu City, 6000 Cebu</p>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">(02) 269 9350</p>
       <br>
       <h4 align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Baranggay.', '.$firedata->Municipality.' Fire Victims</h4>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Date.', '.$firedata->Time.'</p>
       <p align="center" style="margin: 0; padding: 0;font-family: Tahoma, Geneva, sans-serif">'.$firedata->Sitio.', '.$firedata->Baranggay.', '.$firedata->Municipality.', '.$firedata->Province.'</p>
       <br>';
     }
     $output .= '
       <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
      <th style="border: 1px solid; padding:12px;" width="10%">#</th>
      <th style="border: 1px solid; padding:12px;" width="30%">Name</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Validated</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Resident Category</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Date</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Signature</th>
     </tr>
       ';

     foreach($victimsdata as $customer)
     {
      $number = $number + 1;
      $output .= '
      <tr  style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
       <td style="border: 1px solid; padding:12px;">'.$number.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->lastname.', '.$customer->firstname.' '.$customer->middlename.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->verified.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->residentCategory.'</td>
       <td style="border: 1px solid; padding:12px;"></td>
       <td style="border: 1px solid; padding:12px;"></td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

    function verifiedPdf(Request $request)
    {
      $code = $request->input('codename');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper('legal', 'portrait');
      $pdf->loadHTML($this->convert_verifiedlist_to_html($code));
      return $pdf->stream();
    }

    function convert_verifiedlist_to_html($code)
    {
     $victimsdata = $this->getVicDataVerified($code);
     $records = $this->getFireData($code);
     $number = 0;
     foreach ($records as $firedata) {
       $output = '
       <img src="'. public_path() .'/img/dsws.png" style= "width: 30; height: 30; margin: 0; margin-top: 18px; margin-left: 140px; padding: 0; position: fixed;"/>

       <h5 align="center" style="margin: 0; padding: 0; margin-top: 20px; font-family: Tahoma, Geneva, sans-serif">DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h5>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">DSWS Bldg., Katipunan St., Cebu City, 6000 Cebu</p>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">(02) 269 9350</p>
       <br>
       <h4 align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Baranggay.', '.$firedata->Municipality.' Fire Victims</h4>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Date.', '.$firedata->Time.'</p>
       <p align="center" style="margin: 0; padding: 0;font-family: Tahoma, Geneva, sans-serif">'.$firedata->Sitio.', '.$firedata->Baranggay.', '.$firedata->Municipality.', '.$firedata->Province.'</p>
       <br>';
     }
     $output .= '
       <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
      <th style="border: 1px solid; padding:12px;" width="10%">#</th>
      <th style="border: 1px solid; padding:12px;" width="30%">Name</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Validated</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Resident Category</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Date</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Signature</th>
     </tr>
       ';

     foreach($victimsdata as $customer)
     {
      $number = $number + 1;
      $output .= '
      <tr  style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
       <td style="border: 1px solid; padding:12px;">'.$number.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->lastname.', '.$customer->firstname.' '.$customer->middlename.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->verified.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->residentCategory.'</td>
       <td style="border: 1px solid; padding:12px;"></td>
       <td style="border: 1px solid; padding:12px;"></td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

    function residentCategoryPdf(Request $request)
    {
      $code = $request->input('codename');
      $category = $request->input('category');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper('legal', 'portrait');
      $pdf->loadHTML($this->convert_residentCategory_to_html($code, $category));
      return $pdf->stream();
    }

    function convert_residentCategory_to_html($code, $category)
    {
      if($category == 'House Owner Totally'){
         $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('residentCategory', 'House Owner Totally')->get();
      }
      elseif($category == 'House Owner Partially'){
         $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('residentCategory', 'House Owner Partially')->get();
      }
      elseif($category == 'Absentee Owner'){
         $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('residentCategory', 'Absentee Owner')->get();
      }
      elseif($category == 'Sharer'){
         $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('residentCategory', 'Sharer')->get();
      }
      elseif($category == 'Renter'){
         $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('residentCategory', 'Renter')->get();
      }
      elseif($category == 'Lodger/Boarder'){
         $victimsdata = DB::table($code)->orderBy('lastname', 'ASC')->where('residentCategory', 'Lodger or Border')->get();
      }

     $records = $this->getFireData($code);
     $number = 0;
     foreach ($records as $firedata) {
       $output = '
       <img src="'. public_path() .'/img/dsws.png" style= "width: 30; height: 30; margin: 0; margin-top: 18px; margin-left: 140px; padding: 0; position: fixed;"/>

       <h5 align="center" style="margin: 0; padding: 0; margin-top: 20px; font-family: Tahoma, Geneva, sans-serif">DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h5>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">DSWS Bldg., Katipunan St., Cebu City, 6000 Cebu</p>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">(02) 269 9350</p>
       <br>
       <h4 align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Baranggay.', '.$firedata->Municipality.' Fire Victims</h4>
       <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Date.', '.$firedata->Time.'</p>
       <p align="center" style="margin: 0; padding: 0;font-family: Tahoma, Geneva, sans-serif">'.$firedata->Sitio.', '.$firedata->Baranggay.', '.$firedata->Municipality.', '.$firedata->Province.'</p>
       <br>';
     }
     $output .= '
       <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
      <th style="border: 1px solid; padding:12px;" width="10%">#</th>
      <th style="border: 1px solid; padding:12px;" width="30%">Name</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Validated</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Resident Category</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Date</th>
      <th style="border: 1px solid; padding:12px;" width="15%">Signature</th>
     </tr>
       ';

     foreach($victimsdata as $customer)
     {
      $number = $number + 1;
      $output .= '
      <tr  style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
       <td style="border: 1px solid; padding:12px;">'.$number.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->lastname.', '.$customer->firstname.' '.$customer->middlename.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->verified.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->residentCategory.'</td>
       <td style="border: 1px solid; padding:12px;"></td>
       <td style="border: 1px solid; padding:12px;"></td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

    public function getQRCodes(Request $request){
        $codename = $request->input('codename');
        $region = $request->input('region');
        $records = DB::table('reportedfireincidents')->where('codeName', $codename)->get();
        $info = DB::table($codename)->get();
        return view('qrcode-id-list')
        ->with('records',$records)
        ->with('info',$info);
    }

    function QRCodeIDspdf(Request $request)
    {
      $code = $request->input('codename');
      $ids = $request->input('ids');
      $qrcode_id_pdf = \App::make('dompdf.wrapper');
      $qrcode_id_pdf = PDF::setOptions(['images' => true]);
      $qrcode_id_pdf->setPaper('legal', 'portrait');
      $qrcode_id_pdf->loadHTML($this->convert_qrcodedata_to_html($code, $ids));
      return $qrcode_id_pdf->stream();
    }

    function convert_qrcodedata_to_html($code, $ids){
       $victimsdata = $this->getVicData($code);
       $records = $this->getFireData($code);
       $pages = explode("-", $ids);
       if(sizeof($pages) == 1){
         $min = (int)$pages[0];
         $max = (int)($pages[0]);
       }else{
         $min = (int)$pages[0];
         $max = (int)($pages[1]);
       }

       $number = 0;
       $output = '<br><br><br><br>';

       foreach ($victimsdata as $victims) {
         if($victims->id >= $min && $victims->id <= $max){
           if($number > 0 && $number % 2 == 0){
             $output .= '
              <div><p style="margin: 0; padding: 5px;"></p></div>';
           }
           if($number > 0 && ($number % 2 !=0 || $number %2 == 0)){
             $output .= '
              <br><br>';
           }
           if($number > 0 && $number % 3 == 0){
             $output .= '
              <div style="page-break-before: always;"></div>
              <br><br><br><br>
              ';
           }

           $output .= '
           <div class="container" style="padding: 5px; margin-left: 70px; margin-right: 70px; border: 1px solid black; height: 310px; font-family: Tahoma, Geneva, sans-serif">
           <div class="row" style="margin: 0px;  padding: 0px; padding-bottom: 0px;">
             <div style="padding-left: 100px; padding-right: 100px; margin-top: 5px;">
               <img src="'. public_path() .'/img/dswsheader.png" style= "margin: 0; padding: 0;"/>
             </div>
             <div style="text-align:center; padding-left: 50px; padding-right: 200px;">
              <div style="float: left"><img src="'. public_path() .'/img/img-'. $victims->id .'.png" style= "width: 170; height: 170;"/></div>
              <div style="display: inline"></div>
              <div style="float: right; margin-top: 50px;">
                <p align="center" style="margin: 0; padding: 0; margin-left: 0px; font-size: 15px;"><b>'. $victims->firstname .' '. $victims->middlename .' '. $victims->lastname .'</p>
                <p align="center" style="margin: 0; padding: 0; margin-left: 0px; font-size: 14px;">'. $victims->head_age .'</p>
                <p align="center" style="margin: 0; padding: 0; margin-left: 0px; font-size: 14px;">'. $victims->headGender .'</p><br><br>
                <p align="center" style="margin: 0; padding: 0; margin-left: 0px; font-size: 14px;">Approved by:</p>
                <p align="center" style="margin: 10; padding: 0; margin-left: 0px;font-size: 12px">FLORA BARTOLOME</p>
              </div>
             </div>
           </div>
           </div>

             ';
            $number = $number + 1;
        }
       }

       return $output;
    }

    function assistancePdf(Request $request)
    {
       $code = $request->input('codename');
       $pdf = \App::make('dompdf.wrapper');
       $pdf->setPaper('legal', 'portrait');
       $pdf->loadHTML($this->convert_assistance_to_html($code), 'UTF-8');
       return $pdf->stream();
    }

    function convert_assistance_to_html($code){
       $victimsdata = $this->getVicData($code);
       $records = $this->getFireData($code);
       $number = 0;
       foreach ($records as $firedata) {
         $output = '
         <img src="'. public_path() .'/img/dsws.png" style= "width: 30; height: 30; margin: 0; margin-top: 8px; margin-left: 120px; padding: 0; position: fixed;"/>
           <h5 align="center" style="margin: 0; margin-top: 10px; padding: 0; font-family: Tahoma, Geneva, sans-serif">DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h5>
           <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">DSWS Bldg., Katipunan St., Cebu City, 6000 Cebu</p>
           <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">(02) 269 9350</p>
           <br>
           <h4 align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Baranggay.', '.$firedata->Municipality.' Fire Victims</h4>
           <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Date.', '.$firedata->Time.'</p>
           <p align="center" style="margin: 0; padding: 0; font-family: Tahoma, Geneva, sans-serif">'.$firedata->Sitio.', '.$firedata->Baranggay.', '.$firedata->Municipality.', '.$firedata->Province.'</p>
           <br>';
       }
       $output .= '
          <table width="95%" style="border-collapse: collapse; border: 0px;">
          <tr style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
          <th style="border: 1px solid; padding:10px;" width="5%">#</th>
          <th style="border: 1px solid; padding:10px;" width="10%">Name</th>
          <th style="border: 1px solid; padding:10px;" width="5%">Validated</th>
          <th style="border: 1px solid; padding:10px;" width="8%">Food Packs</th>
          <th style="border: 1px solid; padding:10px;" width="8%">Relief Packs</th>
          <th style="border: 1px solid; padding:10px;" width="8%">Health Kits</th>
          <th style="border: 1px solid; padding:10px;" width="8%">Housing Materials</th>
          <th style="border: 1px solid; padding:10px;" width="8%">Financial Assistance</th>
         </tr>
           ';

       foreach($victimsdata as $customer)
       {
        $number = $number + 1;
        if($customer->assistance1 == NULL){
          $str_food = '5';
        }
        else{
          $str_food = '3';
        }
        if($customer->assistance2 == NULL){
          $str_relief = '5';
        }
        else{
          $str_relief = '3';
        }
        if($customer->assistance3 == NULL){
          $str_health = '5';
        }
        else{
          $str_health = '3';
        }
        if($customer->assistance4 == NULL){
          $str_house = '5';
        }
        else{
          $str_house = '3';
        }
        if($customer->assistance5 == NULL){
          $str_fin = '5';
        }
        else{
          $str_fin = '3';
        }

        $output .= '
        <tr  style="text-align: center; font-family: Tahoma, Geneva, sans-serif">
         <td style="border: 1px solid; padding:10px;">'.$number.'</td>
         <td style="border: 1px solid; padding:10px;">'.$customer->lastname.', '.$customer->firstname.' '.$customer->middlename.'</td>

         <td style="border: 1px solid; padding:10px;">'.$customer->verified.'</td>
         <td style="border: 1px solid; padding:10px; font-family: ZapfDingbats, sans-serif;">'.$str_food.'</td>
         <td style="border: 1px solid; padding:10px; font-family: ZapfDingbats, sans-serif;">'.$str_relief.'</td>
         <td style="border: 1px solid; padding:10px; font-family: ZapfDingbats, sans-serif;">'.$str_health.'</td>
         <td style="border: 1px solid; padding:10px; font-family: ZapfDingbats, sans-serif;">'.$str_house.'</td>
         <td style="border: 1px solid; padding:10px; font-family: ZapfDingbats, sans-serif;">'.$str_fin.'</td>
        </tr>
        ';
       }
       $output .= '</table>';
       return $output;
     }

     public function search(Request $request){
       $search = $request->input('search');
       $records = DB::table('reportedfireincidents')->where('Date', 'like', '%'.$search.'%')
                                                    ->orWhere('Baranggay', 'like', '%'.$search.'%')
                                                    ->orWhere('Sitio', 'like', '%'.$search.'%')
                                                    ->orWhere('Municipality', 'like', '%'.$search.'%')
                                                    ->paginate(8);
       return view('firedata', ['records' => $records]);
     }

     public function searchInfo(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('victimsdata', ['info' => $info], ['records' => $records]);
     }

     public function searchMoreInfo(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->orWhere('residentCategory', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('victimsdata-more-info', ['info' => $info], ['records' => $records]);
     }

     public function searchMoreInfoSocialWork(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('victims-more-info-socialwork', ['info' => $info], ['records' => $records]);
     }

     public function searchEditData(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('editdata', ['info' => $info], ['records' => $records]);
     }

     public function searchPartialList(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('final-list', ['info' => $info], ['records' => $records]);
     }

     public function searchVerifiedList(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('verifiedlist', ['info' => $info], ['records' => $records]);
     }

     public function searchAssistance(Request $request){
       $search = $request->input('search');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where('firstname', 'like', '%'.$search.'%')
                               ->orWhere('middlename', 'like', '%'.$search.'%')
                               ->orWhere('lastname', 'like', '%'.$search.'%')
                               ->paginate(10);
       return view('assistance', ['info' => $info], ['records' => $records]);
     }

     public function delete(Request $request){
       $firstname = $request->input('fname');
       $middlename = $request->input('mname');
       $lastname = $request->input('lname');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       DB::table($code)->where([['firstname','=',$firstname],['middlename','=', $middlename], ['lastname','=', $lastname]])->delete();
       $info = DB::table($code)->get();
       return view('editdata', ['info' => $info], ['records' => $records]);
     }

     public function updatePage(Request $request){
       $firstname = $request->input('fname');
       $middlename = $request->input('mname');
       $lastname = $request->input('lname');
       $code = $request->input('codename');
       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       $info = DB::table($code)->where([['firstname','=',$firstname],['middlename','=', $middlename], ['lastname','=', $lastname]])->get();
       return view('updatedata', ['info' => $info], ['records' => $records]);
     }

     public function updateData(Request $request){
       $code = $request->input('codename');
       $origfname = $request->input('prevfname');
       $origmname = $request->input('prevmname');
       $origlname = $request->input('prevlname');

       $firstname = $request->input('fname');
       $middlename = $request->input('mname');
       $lastname = $request->input('lname');
       $age = $request->input('age');
       $verified = $request->input('verified');
       $occupation = $request->input('occupation');
       $headGender = $request->input('headGender');
       $bday = $request->input('bday');
       $address = $request->input('address');
       $civil_status = $request->input('civil_status');
       $income = $request->input('income');
       $ethnicity = $request->input('ethnicity');
       $fps = $request->input('fps');
       $residentCat = $request->input('residentCat');
       $special = $request->input('special');
       $health = $request->input('health');
       $fami1 = $request->input('fami1');
       $fami2 = $request->input('fami2');
       $fami3 = $request->input('fami3');


       if($residentCat == 'Renter'){
         $renterOf = $request->input('renterOf');
       }elseif ($residentCat == 'Sharer') {
         $sharerOf = $request->input('sharerOf');
       }elseif ($residentCat == 'Lodger or Boarder') {
         $lodgerOf = $request->input('lodgerOf');
       }else {
         $renterOf = '';
         $sharerOf = '';
         $lodgerOf = '';
       }

       $source = $request->input('source');
       $witness = $request->input('witness');
       $interviewer = $request->input('interviewer');
       $dateReg = $request->input('dateReg');
       $validator = $request->input('validator');
       $dateVal = $request->input('dateVal');

       $records = DB::table('reportedfireincidents')->where('codeName', $code)->get();
       DB::table($code)->where([['firstname','=', $origfname],['middlename','=', $origmname], ['lastname','=', $origlname]])
                      ->update(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname,'head_age' => $age, 'verified' => $verified, 'occupation' => $occupation,
                                'headGender' => $headGender, 'headBirthdate' => $bday, 'income' => $income, 'residentCategory' => $residentCat, 'address' => $address, 'civil_status' => $civil_status,
                                'renterOf' => $renterOf, 'lodgerOf' => $lodgerOf, 'sharerOf' => $sharerOf, 'specialSpecs' => $special, 'healthCondition' => $health, 'ethnicity' => $ethnicity,
                                'FPSMember' => $fps, 'familyMember_1' => $fami1, 'familyMember_2' => $fami2, 'familyMember_3' => $fami3,
                                'infoSource' => $source, 'witness' => $witness, 'interviewer' => $interviewer, 'dateRegistered' => $dateReg, 'validator' => $validator, 'dateValidated' => $dateVal]);

       $info = DB::table($code)->get();
       return view('editdata', ['info' => $info], ['records' => $records]);
     }




}
