
<tr>
    <td>Name</td>
    <td>{{ isset($allreviews->name) ? $allreviews->name: '' }}</td>
</tr>
<tr>
    <td>Review</td>
    <td>{{ isset($allreviews->review) ? $allreviews->review: '' }}</td>
</tr>

<!-- <tr>
    <td>Image</td>
    <td><a href="{{ url('public/admin/assets/img/testimonial') }}/{{ isset($testimonial->image)? $testimonial->image : '' }}" target="blank">view</a></td>
</tr> -->