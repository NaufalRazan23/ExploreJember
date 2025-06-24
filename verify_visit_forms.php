<?php

use App\Models\VisitForm;
use App\Models\Destination;
use App\Models\User;

echo "=== VISIT FORM DATA VERIFICATION ===\n\n";

echo "Total visit forms: " . VisitForm::count() . "\n";
echo "Total users (role: user): " . User::where('role', 'user')->count() . "\n";
echo "Total destinations: " . Destination::count() . "\n\n";

echo "Visit forms by destination:\n";
$destinations = Destination::withCount('visitForms')->get();
foreach ($destinations as $destination) {
    echo "- {$destination->name}: {$destination->visit_forms_count} forms\n";
}

echo "\nSample visit form data:\n";
$sampleForm = VisitForm::with('user', 'destination')->first();
if ($sampleForm) {
    echo "- User: {$sampleForm->user->name}\n";
    echo "- Destination: {$sampleForm->destination->name}\n";
    echo "- Visit Type: {$sampleForm->visit_type}\n";
    echo "- Group Size: {$sampleForm->group_size}\n";
    echo "- Visit Date: {$sampleForm->visit_date}\n";
    echo "- Arrival Time: {$sampleForm->arrival_time}\n";
    echo "- Departure Time: {$sampleForm->departure_time}\n";
}

echo "\nGroup size statistics:\n";
$minGroupSize = VisitForm::min('group_size');
$maxGroupSize = VisitForm::max('group_size');
$avgGroupSize = VisitForm::avg('group_size');

echo "- Min group size: {$minGroupSize}\n";
echo "- Max group size: {$maxGroupSize}\n";
echo "- Average group size: " . round($avgGroupSize, 2) . "\n";

echo "\nVisit types distribution:\n";
$visitTypes = VisitForm::selectRaw('visit_type, COUNT(*) as count')
    ->groupBy('visit_type')
    ->get();

foreach ($visitTypes as $type) {
    echo "- {$type->visit_type}: {$type->count}\n";
}
