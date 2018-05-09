<div class='details'>* Required fields</div>

<label for='identification'>* Employee Identification</label>
<input type='text' name='identification' id='identification' value='{{ old('identification', $employee->identification) }}'>
@include('modules.error-field', ['field' => 'identification'])

<label for='first_name'>* First Name</label>
<input type='text' name='first_name' id='first_name' value='{{ old('first_name', $employee->first_name) }}'>
@include('modules.error-field', ['field' => 'first_name'])

<label for='last_name'>* Last Name</label>
<input type='text' name='last_name' id='last_name' value='{{ old('last_name', $employee->last_name) }}'>
@include('modules.error-field', ['field' => 'last_name'])

<label for='address_line_1'>* Address Line 1</label>
<input type='text' name='address_line_1' id='address_line_1' value='{{ old('address_line_1', $employee->address_line_1) }}'>
@include('modules.error-field', ['field' => 'address_line_1'])

<label for='address_line_2'> Address Line 2</label>
<input type='text' name='address_line_2' id='address_line_2' value='{{ old('address_line_2', $employee->address_line_2) }}'>
@include('modules.error-field', ['field' => 'address_line_2'])

<label for='city'>* City</label>
<input type='text' name='city' id='city' value='{{ old('city', $employee->city) }}'>
@include('modules.error-field', ['field' => 'city'])

<label for='state'>* State</label>
<input type='text' name='state' id='state' value='{{ old('state', $employee->state) }}'>
@include('modules.error-field', ['field' => 'state'])

<label for='zip_code'>* Zip Code</label>
<input type='text' name='zip_code' id='zip_code' value='{{ old('zip_code', $employee->zip_code) }}'>
@include('modules.error-field', ['field' => 'zip_code'])

<label for='telephone_number'>* Telephone Number</label>
<input type='text' name='telephone_number' id='telephone_number' value='{{ old('telephone_number', $employee->telephone_number) }}'>
@include('modules.error-field', ['field' => 'telephone_number'])

<label for='age'>* Age</label>
<input type='text' name='age' id='age' value='{{ old('age', $employee->age) }}'>
@include('modules.error-field', ['field' => 'age'])

<label for='sex'>* Sex</label>
<input type='text' name='sex' id='sex' value='{{ old('sex', $employee->sex) }}'>
@include('modules.error-field', ['field' => 'sex'])


<label>Skills</label>
@foreach($skillsForCheckboxes as $skillId => $skillName)
    <ul class='tags'>
        <li>
            <label>
                <input
                    {{ (in_array($skillId, $skills)) ? 'checked' : '' }}
                    type='checkbox'
                    name='skills[]'
                    value='{{ $skillId }}'>
                {{ $skillName }}
            </label>
        </li>
    </ul>
@endforeach