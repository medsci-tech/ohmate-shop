<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnterpriseBasicStatistics
 *
 * @property integer $id
 * @property string $date
 * @property integer $focus_count
 * @property integer $register_count ע
 * @property integer $doctor_count ҽʦ
 * @property float $bean_count
 * @property float $income_count Ӫҵ
 * @property integer $article_count
 * @property integer $order_count
 * @property integer $commodity_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereFocusCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereRegisterCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereDoctorCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereBeanCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereIncomeCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereArticleCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereOrderCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereCommodityCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseBasicStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EnterpriseBasicStatistics extends Model
{
    protected $table = 'enterprise_basic_statistics';
}
