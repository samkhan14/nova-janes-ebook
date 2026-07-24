<x-mail::message>
# New Contact Form Message

Someone submitted the Jane Mansons contact form.

**Username:** {{ $name }}  
**First Name:** {{ $firstName }}  
**Last Name:** {{ $lastName }}  
**Email:** {{ $email }}

**Message:**  
{{ $contactMessage }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
