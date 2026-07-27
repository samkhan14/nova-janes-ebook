<x-mail::message>
# New Contact Form Message

Someone submitted the Jane Mansons contact form.

**Name:** {{ $name }}  
**Email:** {{ $email }}

**Message:**  
{{ $contactMessage }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
