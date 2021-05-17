<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'invoice_number' => $this->faker->numerify('invoice-#######'),
            'invoice_date' => $this->faker->date(
                $format = 'Y-m-d',
                $startDate = '-5 days',
                $max = '+5 days'
            ),
            'invoice_due_date' => $this->faker->date(
                $format = 'Y-m-d',
                $startDate = '+5 days',
                $max = '+30 days'
            ),
            'subtotal' => $this->faker->randomFloat(
                $nbMaxDecimals = 2, 
                $min = 1,
                $max = 9000
            ),
            'tax' => $this->faker->randomNumber($nbDigits = 2),
            'discount' => $this->faker->randomNumber($nbDigits = 2), 
            'total' => $this->faker->randomFloat(
                $nbMaxDecimals = 2, 
                $min = 1,
                $max = 9000
            ),
            'company_name' => $this->faker->company,
            'full_name' => $this->faker->name,
            'company_website' => $this->faker->domainName,
            'company_address' => $this->faker->streetAddress,
            'company_city_state_zip' => $this->faker->city . ', ' . 
                $this->faker->state . ' ' . $this->faker->postcode,
            'country' => $this->faker->country,
            'company_phone' => $this->faker->phoneNumber,
            'company_email' => $this->faker->companyEmail,
            'company_logo' => $this->faker->image('storage/app/public/',640,480, null, false),
            'client_company_name' => $this->faker->company,
            'client_full_name' => $this->faker->name,
            'client_address' => $this->faker->streetAddress,
            'client_city_state_zip' => $this->faker->city . ', ' . 
                $this->faker->state . ' ' . $this->faker->postcode,
            'client_country' => $this->faker->country,
            'notes' => $this->faker->sentence($nbWords = 10, $variableNbWords = true)
        ];
    }
}
