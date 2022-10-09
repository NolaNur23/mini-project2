<?php

namespace App\Http\Controllers;

use App\Models\Majors;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        return view('majors.index');
    }
    public function getData(Request $r)
    {
        $id = $r->id;
        if ($id) {
            $data = Majors::where('id', $id)->first();
            $data->no = $no = 1;
        } else {
            $data = Majors::get();
            $no = 0;
            foreach ($data as $a) {
                $a->no = $no += 1;
                // $a->tgl = date_format($a->created_at, "d-M-Y");
            }
        }
        $result = [
            "data" => $data,
        ];
        return response()->json($result);
    }
   
    public function Create(Request $r)
    {
        // $cek=Majo
        $cek = Majors::where('name', $r->name)->first();
        if ($cek) {
            $result['status'] = true;
            $result['message'] = "Failed to Create New Major, Major Already Exists";
            return response()->json($result);
            // session()->flash('message', "Category $request->name sudah ada");
            // return redirect('/category');
            # code...-
        }
        $data = new Majors();
        $data->name = $r->name;
        $data->accreditation = $r->accreditation;
        // $data->id_category = $r->id_category;
        $data->save();
        // $category=News::Category()->name;

        $result['newToken'] = csrf_token();
        $result['status'] = true;
        $result['data'] = $data;
        // $result['category'] = $cate;
        $result['message'] = "Create new major success!!";
        return response()->json($result);
    }
    public function update(Request $r, $id)
    {
        $data = majors::where('id', $id)->first();
        if (!$data) {
            return $this->getResult("Majors not found ");
        }
        $cek = Majors::where('name', $r->name)->where('id', '!=', $id)->first();

        if ($cek) {
            return $this->getResult("Failed to Update Major, Major Already Exists ",true);
        } else {
            $data->name = $r->name;
            $data->accreditation = $r->accreditation;
            $data->save();
            return $this->getResult("Update Major Successfully",true, $data);
          }
        return response()->json($result);
    }
    public function delete($id)
    {
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];
        $data = Majors::where('id', $id)->first();
        if (!$data) {
            $result['message'] = "Majors not found";
            return response()->json($result);
        }
        $data->delete();
        $result['status'] = true;
        $result['message'] = "Major has been deleted";
        return response()->json($result);
    }
}
