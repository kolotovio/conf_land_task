<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        $user = [
            'uuid' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName($gender),
            'middle_name' => $this->faker->middleName($gender),
            'last_name' => $this->faker->lastName($gender),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->PhoneNumber(),
            'company' => $this->faker->company(),
            'job_title' => $this->faker->jobTitle(),
        ];

        // Make a Secret Link
        $secretLink = config('app.url') . '/' . $user['uuid'];

        // Make SVG image with QRcoded Secret Link
        $qr = QrCode::size(200)->generate($secretLink);

        // Store SVG Image to local filesystem
        Storage::disk('public')->put('qrcodes/' . $user['uuid'] . '.svg', $qr);

        return $user;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
