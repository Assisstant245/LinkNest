<x-mail::message>
# Your daily digest for {{ $page->profile_name }}

Here's how your page did over the last 24 hours.

<x-mail::panel>
**{{ $viewCount }}** {{ \Illuminate\Support\Str::plural('view', $viewCount) }} · **{{ $clickCount }}** {{ \Illuminate\Support\Str::plural('click', $clickCount) }}
</x-mail::panel>

@if ($topLinks->isNotEmpty())
## Top links

<x-mail::table>
| Link | Clicks |
| :--- | ---: |
@foreach ($topLinks as $link)
| {{ $link['label'] }} | {{ $link['clicks'] }} |
@endforeach
</x-mail::table>
@endif

<x-mail::button :url="route('analytics')">
View full analytics
</x-mail::button>

Thanks for using LinkNest.
</x-mail::message>
