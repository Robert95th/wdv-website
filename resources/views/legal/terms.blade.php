@extends('layouts.app')

@section('title', 'Terms of Service - W.D.V. Schickerling')

@section('content')
<section class="bg-cream py-16 border-b border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-serif-custom text-4xl md:text-5xl text-navy mb-4">Terms of Service</h1>
        <p class="text-gray-600">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-700 leading-relaxed space-y-8">
        
        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">1. Agreement to Terms</h2>
            <p>By accessing this website and engaging the services of W.D.V. Schickerling, you agree to be bound by these Terms of Service. If you do not agree with any part of these terms, please do not use our website or services.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">2. Nature of Services</h2>
            <p>W.D.V. Schickerling provides professional services related to Insolvency and Estate Administration. Please note that:</p>
            <ul class="list-disc list-inside mt-2 space-y-2 ml-4">
                <li>Information on this website does not constitute formal legal or financial advice.</li>
                <li>An official practitioner to client relationship is only established once we have formally accepted your mandate and confirmed it in writing.</li>
                <li>We act in accordance with the laws of the Republic of Namibia and the directives of the Master of the High Court.</li>
            </ul>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">3. User Responsibilities</h2>
            <p>When using our contact forms or requesting services, you agree to provide accurate, current, and complete information. You are responsible for ensuring that any documents or information you share with us are authentic and legally valid.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">4. Meetings and Estate Listings</h2>
            <p>The dates, venues, and statuses listed on our "Events and Actions" and "Properties for Sale" pages are provided for informational purposes. While we strive to keep this information updated, meeting dates may be subject to change by the Master's Office. We advise you to contact our office directly to confirm the current status of any estate or auction before making travel arrangements.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">5. Intellectual Property</h2>
            <p>All content on this website, including text, logos, and graphics, is the property of W.D.V. Schickerling and is protected by copyright laws. You may not reproduce or distribute our content without prior written permission.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">6. Limitation of Liability</h2>
            <p>While we take great care to ensure the accuracy of the information on this website, W.D.V. Schickerling will not be held liable for any direct or indirect damages arising from the use of, or reliance upon, the information provided on this site. Official communication from our office is required to confirm any legal or estate matters.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">7. Governing Law</h2>
            <p>These Terms of Service are governed by and construed in accordance with the laws of Namibia. Any disputes arising in connection with these terms shall be subject to the exclusive jurisdiction of the Namibian courts.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">8. Contact Information</h2>
            <p>For any questions regarding these Terms, please reach out to us:</p>
            <p class="mt-2 font-medium">
                Email: <a href="mailto:wiam@iande.co" class="text-[#b8935a] hover:underline">wiam@iande.co</a><br>
                Phone: <a href="tel:+264811442959" class="text-[#b8935a] hover:underline">+264 81 144 2959</a>
            </p>
        </div>
    </div>
</section>
@endsection