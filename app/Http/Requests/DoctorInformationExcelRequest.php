<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\CustomerInformation;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Readers\LaravelExcelReader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DoctorInformationExcelRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function persist()
    {
        $filename = $this->moveToLocalStorage($this->file('doctor-information'));
        \Excel::load(storage_path('app/doctor-information/'. $filename), function (LaravelExcelReader $reader) {
            $result = $reader->get();

            foreach ($result as $row) {
                CustomerInformation::create([
                    'name' => $row['姓名'],
                    'type' => substr(trim($row['等级']), 0, 1),
//                    'province' => 
                ]);
            }
        });
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function moveToLocalStorage($file)
    {
        if (!file_exists(storage_path('app/doctor-information'))) {
            \Storage::makeDirectory('doctor-information');
        }

        $disk_filename = Carbon::now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->move(storage_path('app/doctor-information'), $disk_filename);

        return $disk_filename;
    }
}
