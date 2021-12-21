<tr>
    <td>First Name</td>
    <td>{{ isset($alljobs->first_name) ? $alljobs->first_name: '' }}</td>
</tr>
<tr>
    <td>Last Name</td>
    <td>{{ isset($alljobs->last_name) ? $alljobs->last_name: '' }}</td>
</tr>
<tr>
    <td>Address</td>
    <td>{{ isset($alljobs->address) ? $alljobs->address: '' }}</td>
</tr>
<tr>
    <td>DOB</td>
    <td>{{ isset($alljobs->date_of_birth) ? \Carbon\Carbon::parse($alljobs->date_of_birth)->format('Y-m-d') : '' }}</td>
</tr>
<tr>
    <td>Email</td>
    <td>{{ isset($alljobs->email_address) ? $alljobs->email_address: '' }}</td>
</tr>
<tr>
    <td>Phone</td>
    <td>{{ isset($alljobs->phone) ? $alljobs->phone: '' }}</td>
</tr>
<tr>
    <td>CV</td>
    <!-- <td>{{ isset($alljobs->cv) ? $alljobs->cv: '' }}</td> -->
    <td><a style="text-decoration: underline" href="{{ url('public/admin/assets/img/documents') }}/{{ isset($alljobs->cv)? $alljobs->cv : '' }}" target="blank">Click here to view cv</a></td>

</tr>
