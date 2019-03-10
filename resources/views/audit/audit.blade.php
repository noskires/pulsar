@if($diff)
    <h3>Post Changes</h3>

    <div class="author-info">
        <span class="byline">
            Revision by <strong>{{ $diff->user->name }}</strong>
        </span>
        <span class="time-ago">
            {{ \Carbon\Carbon::parse($diff->created_at)->diffForHumans() }}
        </span>
    </div>

    @foreach($diff->getModified() as $field => $value)
        <h3>{{ ucfirst($field) }}</h3>
        <table class="diff">
            <tr>
                <td style="background: #ffe9e9" class="deleted-line">{{ $value["old"] }}</td>
                <td style="background: #e9ffe9" class="added-line">{{ $value["new"] }}</td>
            </tr>
        </table>
    @endforeach
@endif