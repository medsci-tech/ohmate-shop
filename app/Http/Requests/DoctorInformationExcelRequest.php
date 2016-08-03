<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Customer;
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
                $param = [
                    'name'           => $row['姓名'],
                    'type'           => substr(trim($row['等级']), 0, 1),
                    'level'          => 5,
                    'hospital'       => $row['所属医院'],
                    'hospital_level' => $row['医院级别'],
                    'department'     => $row['科室'],
                    'phone'          => strval(intval($row['注册电话'])),
                    'referred_name'  => $row['推荐代表'],
                    'referred_phone' => strval(intval($row['代表电话'])),
                    'region'         => $row['区域9大区'],
                    'region_level'   => $row['销售大区级别'],
                    'responsible'    => $row['销售地区级别'],
                ];

                if ($customer = Customer::where('phone', strval(intval($row['注册电话'])))->first()) {
                    $param['customer_id'] = $customer->id;
                }

                if ($customer_info = CustomerInformation::where('phone', $row['注册电话'])->first()) {
                    $customer_info->update($param);
                    return;
                }

                CustomerInformation::create($param);
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
