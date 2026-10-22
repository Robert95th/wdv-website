@extends('layouts.app')

@section('title', 'Privacy Policy - W.D.V. Schickerling')

@section('content')
<section class="bg-cream py-16 border-b border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-serif-custom text-4xl md:text-5xl text-navy mb-4">Privacy Policy</h1>
        <p class="text-gray-600">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-700 leading-relaxed space-y-8">
        
        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">1. Introduction</h2>
            <p>W.D.V. Schickerling ("we", "our", or "us") is committed to protecting the privacy and confidentiality of your personal information. As registered Insolvency and Estate Practitioners, we handle sensitive financial and personal data daily. This Privacy Policy outlines how we collect, use, and protect your information when you use our website or engage our services.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">2. Information We Collect</h2>
            <p>We may collect the following types of information:</p>
            <ul class="list-disc list-inside mt-2 space-y-2 ml-4">
                <li><strong>Personal Identification:</strong> Names, ID numbers, addresses, and contact details.</li>
                <li><strong>Financial Information:</strong> Bank statements, asset lists, liabilities, and credit agreements (when required for estate administration).</li>
                <li><strong>Legal Documents:</strong> Wills, court orders, marriage certificates, and company registration documents.</li>
                <li><strong>Communication Data:</strong> Emails, phone calls, and messages submitted via our contact forms or newsletters.</li>
            </ul>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">3. How We Use Your Information</h2>
            <p>Your information is used strictly to fulfill our legal and professional obligations, including:</p>
            <ul class="list-disc list-inside mt-2 space-y-2 ml-4">
                <li>Administering insolvent and deceased estates.</li>
                <li>Communicating with the Master of the High Court and relevant creditors.</li>
                <li>Responding to your inquiries and requests for consultations.</li>
                <li>Sending newsletters and updates (if you have opted in).</li>
            </ul>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">4. Confidentiality and Disclosure</h2>
            <p>We do not sell, rent, or trade your personal information. We will only disclose your information to third parties if required by law, court order, or if necessary to complete the administration of an estate (e.g., sharing asset lists with auctioneers). All third parties are bound by strict confidentiality agreements.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">5. Data Security</h2>
            <p>We implement appropriate technical and organizational security measures to protect your data against unauthorized access, alteration, or destruction. Our internal record-keeping is strictly monitored to ensure legal precision and discretion.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">6. Your Rights</h2>
            <p>You have the right to request access to the personal information we hold about you, request corrections, or ask for restrictions on how we process your data, subject to our legal obligations regarding estate administration.</p>
        </div>

        <div>
            <h2 class="font-serif-custom text-2xl text-navy mb-4">7. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy or how your data is handled, please contact us:</p>
            <p class="mt-2 font-medium">
                Email: <a href="mailto:wiam@iande.co" class="text-[#b8935a] hover:underline">wiam@iande.co</a><br>
                Phone: <a href="tel:+264811442959" class="text-[#b8935a] hover:underline">+264 81 144 2959</a><br>
                Address: Unit 402, Fourth Floor, Maerua Mall, Windhoek, Namibia
            </p>
        </div>
    </div>
</section>
@endsection