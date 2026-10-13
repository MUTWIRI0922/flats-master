<div>
    <p>Dear {{ $tenant->first_name }},</p>
    <p>You've been added as a tenant to {{ $property->name }}, house number {{ $unit->unit_number }}.</p>
    <p>Your login credentials are as follows:</p>
    <p>Email: {{ $tenant->email }}</p>
    <p>Password: {{ $password }}</p>
    <p>We are excited to have you on board and look forward to providing you with a comfortable living experience.</p>
    <p>Best regards,</p>
    <p>The Flat Master Team</p>
</div>