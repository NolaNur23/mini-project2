<?php

namespace App\Http\Controllers;

use App\Models\Majors;
use App\Models\Students;
use Illuminate\Http\Request;

// use App\;

class StudentsController extends Controller
{
    public function index()
    {

        $data = Majors::get();
        return view('students.index', compact('data'));
    }
    public function getData(Request $r)
    {
        $id = $r->id;
        if ($id) {
            $data = Students::where('id', $id)->first();
            $data->no = $no = 1;
        } else {
            $data = Students::with('Major')->get();
            // $data = News::with('Category')->onlyTrashed()->get();
            // $data = News::with('Category')->withTrashed()->get();
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
        $cek = Students::where('no_bp', $r->no_bp)->first();
        if ($cek) {
            return $this->getResult("Failed to Create New Student, student Already Exists", true);
        }
        $data = new Students();
        $data->no_bp = $r->no_bp;
        $data->name = $r->name;
        $data->id_majors = $r->id_majors;
        $data->gender = $r->gender;
        $data->status = $r->status;
        $data->address = $r->address;
        // $data->accreditation = $r->accreditation;
        $data->save();
        return $this->getResult("Create new major success!!", true, $data);
    }
    public function update(Request $r, $id)
    {
        $data = Students::where('id', $id)->first();
        if (!$data) {
            return $this->getResult("Students not found", true, $data);
        }
        $cek = Students::where('no_bp', $r->no_bp)->where('id', '!=', $id)->first();

        if ($cek) {
            return $this->getResult("Update Student Fail!!no_bp already exists", true, );
        } else {
            // $data = new Students();
            $data->no_bp = $r->no_bp;
            $data->name = $r->name;
            $data->id_majors = $r->id_majors;
            $data->gender = $r->gender;
            $data->status = $r->status;
            $data->address = $r->address;
            $data->save();
            return $this->getResult("Update Category Successfully", true, $data);

        }
        return $this->getResult("");

    }
    public function delete($id)
    {
        $data = Students::where('id', $id)->first();
        if (!$data) {
            return $this->getResult("Students not found", true, $data);
        }
        $data->delete();
        return $this->getResult("Students  has been deleted", true, $data);
    }
    public function indexRestore()
    {
        $data = Majors::get();

        return view('students.trash', compact('data'));
    }
    public function getDataRestore(Request $r)
    {
        $id = $r->id;
        if ($id) {
            $data = Students::where('id', $id)->first();
            $data->no = $no = 1;
        } else {
            // $data = News::with('Category')->get();
            $data = Students::with('Major')->onlyTrashed()->get();
            // $data = News::with('Category')->withTrashed()->get();
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
    public function restoreData($id)
    {

        $restore = Students::where('id', $id)->onlyTrashed()->restore();

        if ($restore) {
            return $this->getResult("Students  has been Restored", true);
        }
    }
    public function deletePermanentData($id)
    {
        $delete = Students::where('id', $id)->forceDelete();
        if ($delete) {
            return $this->getResult("Success delete Permanent", true);
        }
    }

}
