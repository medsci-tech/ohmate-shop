<?php


namespace app\Jobs\BeansFeed;


use App\Jobs\Job;
use App\Models\BeanRate;
use App\Models\Customer;

abstract class BeansFeed extends Job
{
    public $beans = 0;
    public $name = 'undefined';
    public $customer = null;
    public $before = 0;
    public $after = 0;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        $this->before = $customer->beans_total;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \DB::transaction($this->transaction());
    }

    protected abstract function transaction();

    protected function persist()
    {
        $bean_rate = BeanRate::where('action_en', '=', $this->name)->firstOrFail();
        $this->customer->beans()->create([
            'bean_rate_id' => $bean_rate->id,
            'value' => 1,
            'result' => $this->beans,
            'before' => $this->before,
            'after' => $this->after,
        ]);
    }
}