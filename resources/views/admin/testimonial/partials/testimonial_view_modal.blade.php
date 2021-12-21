
<tr>
    <td>Name</td>
    <td>{{ isset($allreviews->name) ? $allreviews->name: '' }}</td>
</tr>
<tr>
    <td>Review</td>
    <td>{{ isset($allreviews->review) ? $allreviews->review: '' }}</td>
</tr>

<tr>
    <td>Status</td>
    <td>
        @php
        $class = '';
        switch ($allreviews->review_status_code) {
          case 1:
            $class = 'badge-success';
            break;
          default:
            $class = 'badge-primary';
            break;
        }
      @endphp
        <span class="badge {{ $class }}">{{ isset($allreviews->review_status) ?  $allreviews->review_status->review_status_name : ''}}</span></td>
    </td>
</tr>