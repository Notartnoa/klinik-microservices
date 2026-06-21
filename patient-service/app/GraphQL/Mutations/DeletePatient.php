<?php

namespace App\GraphQL\Mutations;

use App\Models\Patient;

class DeletePatient
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

        if ($patient->status === 'inactive') {
            return [
                'success' => false,
                'message' => 'Patient is already inactive',
                'data'    => $patient,
            ];
        }

        $patient->update(['status' => 'inactive']);

        return [
            'success' => true,
            'message' => 'Patient deactivated successfully',
            'data'    => $patient->fresh(),
        ];
    }
}
