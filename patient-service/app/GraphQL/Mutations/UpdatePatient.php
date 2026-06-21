<?php

namespace App\GraphQL\Mutations;

use App\Models\Patient;

class UpdatePatient
{
    public function __invoke($rootValue, array $args)
    {
        $patient = Patient::find($args['id']);

        if (!$patient) {
            return [
                'success' => false,
                'message' => 'Patient not found',
                'data'    => null,
            ];
        }

        $fillable = ['name', 'phone', 'email', 'address', 'status', 'emergency_contact_name', 'emergency_contact_phone'];
        $data = array_filter(
            array_intersect_key($args, array_flip($fillable)),
            fn($v) => $v !== null
        );

        $patient->update($data);

        return [
            'success' => true,
            'message' => 'Patient updated successfully',
            'data'    => $patient->fresh(),
        ];
    }
}
