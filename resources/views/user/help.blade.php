@extends('user.layouts.app')

@section('title', 'Help Page')

@section('content')
    <div class="min-h-screen bg-blue-900 text-white">
        <!-- Hero Section -->
        <div class="bg-gradient-to-b from-blue-800 to-blue-900 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-center text-4xl font-semibold mb-2">Help Center</h1>
                <h2 class="text-center text-3xl mb-6">How can we assist you with your travel plans?</h2>
                <p class="text-center text-blue-200 mb-8">
                    Find answers to your questions or contact our support team.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto flex gap-2">
                    <input type="text" 
                        placeholder="Search for travel topics" 
                        class="w-full px-4 py-2 rounded-lg bg-blue-800 border border-blue-700 focus:outline-none focus:border-yellow-500">
                    <button class="px-6 py-2 bg-yellow-500 text-blue-900 font-semibold rounded-lg hover:bg-yellow-400 transition">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-12">
            <h3 class="text-2xl font-semibold mb-8">Explore all travel topics</h3>

            <!-- Grid Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ openModal: null }">
                <!-- Booking Tours -->
                <div class="bg-blue-800 p-6 rounded-xl">
                    <div class="mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Booking Tours</h4>
                    <ul class="space-y-3 text-blue-200">
                        <li>
                            <button @click="openModal = 'booking1'" class="text-left hover:text-yellow-500">
                                How to book a tour online?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'booking1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">How to book a tour online?</h3>
                                        <div class="text-gray-200">
                                            <p>Booking a tour online is easy! Follow these steps:</p>
                                            <ol class="list-decimal ml-4 mt-2 space-y-2">
                                                <li>Browse our available tours</li>
                                                <li>Select your preferred date</li>
                                                <li>Choose number of participants</li>
                                                <li>Fill in your details</li>
                                                <li>Complete payment</li>
                                            </ol>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'booking2'" class="text-left hover:text-yellow-500">
                                What payment methods are accepted?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'booking2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Payment Methods</h3>
                                        <div class="text-gray-200">
                                            <p>We accept various payment methods including:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Credit/Debit Cards (Visa, MasterCard, American Express)</li>
                                                <li>PayPal</li>
                                                <li>Bank Transfer</li>
                                                <li>Digital Wallets (Apple Pay, Google Pay)</li>
                                            </ul>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'booking3'" class="text-left hover:text-yellow-500">
                                What is your cancellation policy?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'booking3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Cancellation Policy</h3>
                                        <div class="text-gray-200">
                                            <p>Our cancellation policy is designed to be fair and flexible:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Free cancellation up to 7 days before the tour</li>
                                                <li>50% refund for cancellations 3-7 days before</li>
                                                <li>No refund for cancellations less than 3 days before</li>
                                                <li>Full refund if tour is cancelled by us</li>
                                            </ul>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Destinations -->
                <div class="bg-blue-800 p-6 rounded-xl">
                    <div class="mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Destinations</h4>
                    <ul class="space-y-3 text-blue-200">
                        <li>
                            <button @click="openModal = 'dest1'" class="text-left hover:text-yellow-500">
                                What are the most popular destinations?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'dest1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Popular Destinations</h3>
                                        <div class="text-gray-200">
                                            <p>Our most popular destinations include:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Paris, France - City of Love</li>
                                                <li>Tokyo, Japan - Modern Meets Traditional</li>
                                                <li>Bali, Indonesia - Tropical Paradise</li>
                                                <li>New York, USA - The Big Apple</li>
                                                <li>Rome, Italy - Historical Wonder</li>
                                            </ul>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'dest2'" class="text-left hover:text-yellow-500">
                                When is the best time to visit?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'dest2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Best Time to Visit</h3>
                                        <div class="text-gray-200">
                                            <p>The best time to visit depends on your destination:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Europe: April-June or September-October</li>
                                                <li>Southeast Asia: November-February</li>
                                                <li>Caribbean: December-April</li>
                                                <li>Japan: March-May or October-November</li>
                                            </ul>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'dest3'" class="text-left hover:text-yellow-500">
                                What travel documents do I need?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'dest3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Required Travel Documents</h3>
                                        <div class="text-gray-200">
                                            <p>Essential travel documents include:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Valid passport (at least 6 months validity)</li>
                                                <li>Visa (if required)</li>
                                                <li>Travel insurance documents</li>
                                                <li>Vaccination certificates (if required)</li>
                                                <li>Return flight tickets</li>
                                            </ul>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Travel Services -->
                <div class="bg-blue-800 p-6 rounded-xl">
                    <div class="mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Travel Services</h4>
                    <ul class="space-y-3 text-blue-200">
                        <li>
                            <button @click="openModal = 'service1'" class="text-left hover:text-yellow-500">
                                What airport transfers are available?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'service1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Airport Transfer Services</h3>
                                        <div class="text-gray-200">
                                            <p>We offer various airport transfer options:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Private luxury car service</li>
                                                <li>Shared shuttle service</li>
                                                <li>Group transfers for large parties</li>
                                                <li>24/7 service availability</li>
                                                <li>Meet and greet at arrival</li>
                                            </ul>
                                            <p class="mt-4">All transfers can be booked in advance through our website or customer service.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'service2'" class="text-left hover:text-yellow-500">
                                How to book additional activities?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'service2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Booking Additional Activities</h3>
                                        <div class="text-gray-200">
                                            <p>Adding activities to your trip is simple:</p>
                                            <ol class="list-decimal ml-4 mt-2 space-y-2">
                                                <li>Log into your account</li>
                                                <li>Go to 'My Bookings'</li>
                                                <li>Select 'Add Activities'</li>
                                                <li>Choose from available options</li>
                                                <li>Confirm and pay</li>
                                            </ol>
                                            <p class="mt-4">You can also book activities through our mobile app or by contacting customer service.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'service3'" class="text-left hover:text-yellow-500">
                                What about travel insurance options?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'service3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Travel Insurance Coverage</h3>
                                        <div class="text-gray-200">
                                            <p>Our travel insurance packages include:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Trip cancellation coverage</li>
                                                <li>Medical emergency coverage</li>
                                                <li>Lost baggage protection</li>
                                                <li>Flight delay compensation</li>
                                                <li>24/7 emergency assistance</li>
                                            </ul>
                                            <p class="mt-4">Insurance can be added during booking or up to 24 hours before departure.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Special Offers -->
                <div class="bg-blue-800 p-6 rounded-xl">
                    <div class="mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Special Offers</h4>
                    <ul class="space-y-3 text-blue-200">
                        <li>
                            <button @click="openModal = 'offer1'" class="text-left hover:text-yellow-500">
                                What current promotions are available?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'offer1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Current Promotions</h3>
                                        <div class="text-gray-200">
                                            <p>Check out our latest offers:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Early Bird: 20% off on summer bookings</li>
                                                <li>Last Minute Deals: Up to 30% off</li>
                                                <li>Weekend Getaway: Special packages</li>
                                                <li>Family Package: Kids stay free</li>
                                                <li>Extended Stay: 7+ nights get 15% off</li>
                                            </ul>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'offer2'" class="text-left hover:text-yellow-500">
                                How does the loyalty program work?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'offer2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Loyalty Program Benefits</h3>
                                        <div class="text-gray-200">
                                            <p>Our loyalty program has three tiers:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Silver: 5% off all bookings</li>
                                                <li>Gold: 10% off + priority support</li>
                                                <li>Platinum: 15% off + VIP services</li>
                                            </ul>
                                            <p class="mt-4">Points are earned on every purchase and can be redeemed for free tours or upgrades.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'offer3'" class="text-left hover:text-yellow-500">
                                Are there any group discounts?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'offer3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Group Discount Information</h3>
                                        <div class="text-gray-200">
                                            <p>Group discounts are available for:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Groups of 6+: 10% discount</li>
                                                <li>Groups of 10+: 15% discount</li>
                                                <li>School groups: Special rates</li>
                                                <li>Corporate events: Custom packages</li>
                                                <li>Wedding parties: Special arrangements</li>
                                            </ul>
                                            <p class="mt-4">Contact our group booking specialist for more details.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Travel Requirements -->
                <div class="bg-blue-800 p-6 rounded-xl">
                    <div class="mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Travel Requirements</h4>
                    <ul class="space-y-3 text-blue-200">
                        <li>
                            <button @click="openModal = 'req1'" class="text-left hover:text-yellow-500">
                                What are the visa requirements?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'req1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Visa Requirements</h3>
                                        <div class="text-gray-200">
                                            <p>Visa requirements vary by destination and nationality:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Check requirements at least 3 months before travel</li>
                                                <li>Some countries offer visa on arrival</li>
                                                <li>E-visas are available for many destinations</li>
                                                <li>Processing time varies by country</li>
                                                <li>We can assist with visa application process</li>
                                            </ul>
                                            <p class="mt-4">Contact our visa support team for detailed information about your destination.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'req2'" class="text-left hover:text-yellow-500">
                                What health requirements should I know?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'req2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Health Requirements</h3>
                                        <div class="text-gray-200">
                                            <p>Important health considerations:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Required vaccinations by destination</li>
                                                <li>COVID-19 testing requirements</li>
                                                <li>Travel insurance with medical coverage</li>
                                                <li>Health declarations forms</li>
                                                <li>Local health guidelines and restrictions</li>
                                            </ul>
                                            <p class="mt-4">Check with your doctor and local health authorities before travel.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'req3'" class="text-left hover:text-yellow-500">
                                What documents are required for travel?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'req3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Required Travel Documents</h3>
                                        <div class="text-gray-200">
                                            <p>Essential documents for international travel:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Valid passport (6 months validity required)</li>
                                                <li>Visa or entry permit</li>
                                                <li>Travel insurance certificate</li>
                                                <li>Vaccination records</li>
                                                <li>Return flight tickets</li>
                                                <li>Hotel booking confirmations</li>
                                            </ul>
                                            <p class="mt-4">Keep both digital and physical copies of all documents.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Customer Support -->
                <div class="bg-blue-800 p-6 rounded-xl">
                    <div class="mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Customer Support</h4>
                    <ul class="space-y-3 text-blue-200">
                        <li>
                            <button @click="openModal = 'support1'" class="text-left hover:text-yellow-500">
                                How can I contact customer service?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'support1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Contact Customer Service</h3>
                                        <div class="text-gray-200">
                                            <p>You can reach us through multiple channels:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>24/7 Live Chat on our website</li>
                                                <li>Email: nhatquang750505@gmail.com</li>
                                                <li>Phone: 0774505325</li>
                                                <li>Social Media: @travelwebsite</li>
                                                <li>Mobile App Support</li>
                                            </ul>
                                            <p class="mt-4">Average response time: Under 1 hour</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'support2'" class="text-left hover:text-yellow-500">
                                What is your emergency assistance policy?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'support2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Emergency Assistance</h3>
                                        <div class="text-gray-200">
                                            <p>Our emergency support includes:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>24/7 Emergency Hotline</li>
                                                <li>Local Emergency Contacts</li>
                                                <li>Medical Emergency Assistance</li>
                                                <li>Lost Document Support</li>
                                                <li>Emergency Evacuation Services</li>
                                            </ul>
                                            <p class="mt-4">Emergency Hotline: 0774505325</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <button @click="openModal = 'support3'" class="text-left hover:text-yellow-500">
                                How do I submit feedback or complaints?
                            </button>
                            <!-- Modal -->
                            <div x-show="openModal === 'support3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="min-h-screen px-4 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                        <h3 class="text-xl font-bold mb-4">Feedback & Complaints</h3>
                                        <div class="text-gray-200">
                                            <p>We value your feedback:</p>
                                            <ul class="list-disc ml-4 mt-2 space-y-2">
                                                <li>Online feedback form on website</li>
                                                <li>Email to nhatquang750505@gmail.com</li>
                                                <li>Post-trip survey</li>
                                                <li>Customer service chat</li>
                                                <li>Social media channels</li>
                                            </ul>
                                            <p class="mt-4">We aim to respond to all feedback within 24 hours.</p>
                                        </div>
                                        <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Still Need Help Section -->
            <div class="mt-16 text-center">
                <h3 class="text-2xl font-semibold mb-6">Still need help?</h3>
                <button class="px-6 py-3 bg-yellow-500 text-blue-900 font-semibold rounded-lg hover:bg-yellow-400 transition">
                    Contact us now
                </button>
            </div>

            <!-- Travel Tips Section -->
            <div class="mt-16" x-data="{ openModal: null }">
                <p class="text-sm text-blue-300">Travel Tips</p>
                <h3 class="text-2xl font-semibold mb-8">Essential tips for your next adventure</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Tip Card 1 -->
                    <div class="bg-blue-800 rounded-xl overflow-hidden">
                        <img src="https://i.pinimg.com/736x/38/6b/3c/386b3c67a17d09bdc6969e0135aed242.jpg" alt="Packing Tips" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-blue-300 mb-2">December 14, 2023</p>
                            <button @click="openModal = 'tip1'" class="font-semibold hover:text-yellow-500">
                                10 Essential Packing Tips for Long-Term Travel
                            </button>
                        </div>

                        <!-- Modal -->
                        <div x-show="openModal === 'tip1'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                            <div class="min-h-screen px-4 flex items-center justify-center">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                    <h3 class="text-xl font-bold mb-4">10 Essential Packing Tips for Long-Term Travel</h3>
                                    <div class="text-gray-200">
                                        <p class="mb-4">Make your long-term travel easier with these essential packing tips:</p>
                                        <ol class="list-decimal ml-4 space-y-3">
                                            <li>
                                                <strong>Roll Don't Fold:</strong>
                                                <p>Roll your clothes instead of folding to save space and prevent wrinkles.</p>
                                            </li>
                                            <li>
                                                <strong>Pack Multi-Purpose Items:</strong>
                                                <p>Choose clothing that can be worn in multiple ways and situations.</p>
                                            </li>
                                            <li>
                                                <strong>Use Packing Cubes:</strong>
                                                <p>Organize your belongings with packing cubes to maximize space.</p>
                                            </li>
                                            <li>
                                                <strong>Pack Light and Smart:</strong>
                                                <p>Choose lightweight, quick-dry fabrics and limit yourself to 7 days worth of clothes.</p>
                                            </li>
                                            <li>
                                                <strong>Essential Electronics:</strong>
                                                <p>Bring universal adapters and portable chargers for your devices.</p>
                                            </li>
                                            <li>
                                                <strong>Toiletries Strategy:</strong>
                                                <p>Pack travel-size toiletries and refillable containers.</p>
                                            </li>
                                            <li>
                                                <strong>Important Documents:</strong>
                                                <p>Keep digital and physical copies of all important documents.</p>
                                            </li>
                                            <li>
                                                <strong>First Aid Kit:</strong>
                                                <p>Pack basic medications and first aid supplies.</p>
                                            </li>
                                            <li>
                                                <strong>Weather Preparation:</strong>
                                                <p>Include layers and weather-appropriate gear.</p>
                                            </li>
                                            <li>
                                                <strong>Leave Space:</strong>
                                                <p>Keep some space in your luggage for souvenirs and purchases.</p>
                                            </li>
                                        </ol>
                                        <p class="mt-4 text-yellow-500">Pro Tip: Always check your airline's baggage restrictions before packing!</p>
                                    </div>
                                    <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tip Card 2 -->
                    <div class="bg-blue-800 rounded-xl overflow-hidden">
                        <img src="https://i.pinimg.com/736x/a7/f1/47/a7f1473c0d1d86b34cae8066e8fda23f.jpg" alt="Budget Travel" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-blue-300 mb-2">December 10, 2023</p>
                            <button @click="openModal = 'tip2'" class="font-semibold hover:text-yellow-500">
                                How to Travel on a Budget: Money-Saving Strategies
                            </button>
                        </div>

                        <!-- Modal -->
                        <div x-show="openModal === 'tip2'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                            <div class="min-h-screen px-4 flex items-center justify-center">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                    <h3 class="text-xl font-bold mb-4">Budget Travel Strategies</h3>
                                    <div class="text-gray-200">
                                        <p class="mb-4">Smart ways to save money while traveling:</p>
                                        <ul class="list-disc ml-4 space-y-3">
                                            <li>Book flights during off-peak seasons</li>
                                            <li>Use public transportation instead of taxis</li>
                                            <li>Stay in hostels or use home-sharing services</li>
                                            <li>Cook your own meals when possible</li>
                                            <li>Take advantage of free walking tours</li>
                                            <li>Use travel rewards credit cards</li>
                                            <li>Book accommodations with free cancellation</li>
                                            <li>Travel to budget-friendly destinations</li>
                                        </ul>
                                        <p class="mt-4 text-yellow-500">Remember: The cheapest option isn't always the best value!</p>
                                    </div>
                                    <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tip Card 3 -->
                    <div class="bg-blue-800 rounded-xl overflow-hidden">
                        <img src="https://i.pinimg.com/736x/9a/21/fc/9a21fc2d2ea5b00811c7b377d33fc1fa.jpg" alt="Solo Travel" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-blue-300 mb-2">December 5, 2023</p>
                            <button @click="openModal = 'tip3'" class="font-semibold hover:text-yellow-500">
                                The Ultimate Guide to Solo Travel: Tips and Destinations
                            </button>
                        </div>

                        <!-- Modal -->
                        <div x-show="openModal === 'tip3'" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                            <div class="min-h-screen px-4 flex items-center justify-center">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                <div class="relative bg-blue-800 rounded-lg p-8 max-w-md w-full">
                                    <h3 class="text-xl font-bold mb-4">Solo Travel Guide</h3>
                                    <div class="text-gray-200">
                                        <p class="mb-4">Essential tips for solo travelers:</p>
                                        <ul class="list-disc ml-4 space-y-3">
                                            <li>
                                                <strong>Safety First:</strong>
                                                <p>Share your itinerary with family and stay aware of your surroundings.</p>
                                            </li>
                                            <li>
                                                <strong>Best Destinations:</strong>
                                                <p>Japan, New Zealand, Iceland, and Portugal are great for solo travelers.</p>
                                            </li>
                                            <li>
                                                <strong>Accommodation Tips:</strong>
                                                <p>Choose well-reviewed hostels or hotels in safe neighborhoods.</p>
                                            </li>
                                            <li>
                                                <strong>Meeting People:</strong>
                                                <p>Join group tours or use travel apps to meet other travelers.</p>
                                            </li>
                                            <li>
                                                <strong>Documentation:</strong>
                                                <p>Keep copies of important documents in multiple places.</p>
                                            </li>
                                        </ul>
                                        <p class="mt-4 text-yellow-500">Pro Tip: Trust your instincts and don't be afraid to say no!</p>
                                    </div>
                                    <button @click="openModal = null" class="mt-6 bg-yellow-500 text-blue-900 px-4 py-2 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection