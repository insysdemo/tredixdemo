<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;


class CommonController extends Controller
{
    use ApiResponse;

   
    public function getDeleteModal(Request $request)
    {
        $deleteMessage = null;
        $id = base64_decode($request->recordId);
        $data = $request->only('url', 'type');
        $html = (string) view(
            'admin.common.deleteModal',
            compact(
                'data'
            )
        );

        return $this->sendResponse('Page load successfully.', 200, $html);
    }
    public function getMulDeleteModal(Request $request)
    {
        $deleteAllMessage = array();
        // if (isset($request->ids)) {
        //     foreach ($request->ids as $id) {
        //         $checkResult = $this->checkRelatedData($id,$request->moduleName);
        //         if(isset($checkResult)){
        //             $deleteAllMessage[] = $checkResult;
        //         }                
        //     }
        // }
        
        $data = $request->only('url', 'type');
        $html = (string) view('admins.common.deleteMultipleModal',compact('data'));

        return $this->sendResponse('Page load successfully.', 200, $html);
    }

   
}
