<?php


namespace app\Jobs\BeansFeed;


use app\Exceptions\NotEnoughBeansException;
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

    protected function transaction()
    {
        return function () {
            if ($this->beans < 0 && $this->customer->beans_total + $this->beans < 0) {
                throw new NotEnoughBeansException;
            }

            $this->customer->update([
                'beans_total' => $this->customer->beans_total + $this->beans
            ]);
            $this->after = $this->customer->beans_total;
            $this->persist();
        };
    }

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