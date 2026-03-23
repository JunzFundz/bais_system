<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - Republic of the Philippines</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'serif': ['Times New Roman', 'serif'],
                        'script': ['Brush Script MT', 'cursive'],
                    }
                }
            }
        }
    </script>
    <style>
        @font-face {
            font-family: 'CertificateScript';
            src: local('Brush Script MT'), local('BrushScript'), url('data:font/woff2;base64,...') format('woff2');
        }

        .certificate-bg {
            background: linear-gradient(135deg, #f8f4e6 0%, #e8e2d3 50%, #f8f4e6 100%);
            box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-stone-100 to-amber-50 min-h-screen flex items-center justify-center p-8">
    <div class="certificate-bg max-w-4xl w-full mx-auto bg-white rounded-3xl shadow-2xl border-8 border-amber-800/50 p-12 relative overflow-hidden">
        <!-- Watermark -->
        <div class="absolute inset-0 opacity-5 flex items-center justify-center pointer-events-none">
            <div class="text-8xl font-serif font-bold text-amber-800 rotate-[-5deg] tracking-widest">BAIS CITY</div>
        </div>

        <!-- Top Header Section -->
        <div class="text-center relative z-10">
            <!-- Logo 1 (Left) -->
            <div class="absolute left-0 top-0 w-24 h-24 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full shadow-lg flex items-center justify-center">
                <img src="../assets/images/logo1.png" alt="">
            </div>

            <!-- Center Header -->
            <div class="pb-8">
                <p class="text-xl font-serif font-semibold text-gray-700 mt-4 tracking-wide">
                    Republic of the Philippines
                    <br>
                    Province of Negros Oriental
                    <br>
                    City of Bais
                </p>
                <!-- <div class="w-48 h-1 bg-gradient-to-r from-amber-600 to-orange-500 mx-auto rounded-full shadow-md"></div> -->
                <p class="text-xl md:text-2xl font-serif font-semibold text-gray-700 mt-4 uppercase tracking-wide">
                    <?= $d['BRGY'] ?>
                </p>
                <p class="text-xl md:text-2xl font-serif font-semibold text-gray-700 mt-4 uppercase tracking-wide">
                    OFFICE OF THE PUNONG BARANGAY
                </p>
                <!-- <p class="text-lg md:text-xl font-serif italic text-gray-600 mt-1">
                    Division of [Your Division]
                </p> -->
            </div>

            <!-- Logo 2 (Right) -->
            <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-red-600 to-orange-500 rounded-full shadow-lg flex items-center justify-center">
                <img src="../assets/images/logo2.png" alt="">
            </div>
        </div>

        <!-- Certificate Body -->
        <div class="max-w-3xl mx-auto  space-y-8">
            <!-- Certificate Title -->
            <div class="bg-gradient-to-r text-center from-amber-500/20 to-orange-500/20 border-t border-b border-amber-600/50  p-2 backdrop-blur-sm">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-800 uppercase tracking-widest mb-4 drop-shadow-lg">
                    Certification
                </h2>
                <div class="w-32 h-1 bg-gradient-to-r from-amber-600 via-orange-500 to-red-500 mx-auto rounded-full shadow-md"></div>
            </div>

            <!-- Main Content -->
            <div class="text-lg md:text-xl leading-relaxed text-gray-700 font-serif space-y-6 px-8">
                <p>
                    To whom It May Concern:
                </p>
                <p>
                   This is to certify that late: 
                </p>
            </div>

            <!-- Seals/Emblems -->
            <div class="flex flex-col md:flex-row gap-8 justify-center items-center mt-12">
                <div class="w-32 h-32 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl flex flex-col items-center justify-center p-4 text-white font-bold text-sm uppercase tracking-wider">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    Excellence
                </div>
                <div class="w-32 h-32 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl shadow-xl flex flex-col items-center justify-center p-4 text-white font-bold text-sm uppercase tracking-wider">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    Achievement
                </div>
            </div>

            <!-- Signature Section -->
            <div class="mt-16 pt-12 border-t-4 border-dashed border-amber-600/30">
                <div class="grid md:grid-cols-3 gap-8 items-end text-left max-w-2xl mx-auto">
                    <!-- Prepared By -->
                    <div class="text-center md:text-left">
                        <p class="text-sm uppercase tracking-wider text-gray-600 font-semibold mb-2">Prepared by:</p>
                        <div class="h-24 border-t-2 border-gray-400 pt-4">
                            <p class="font-serif font-bold text-lg">MARIA SANTOS</p>
                            <p class="text-sm font-medium text-gray-600">Program Coordinator</p>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="text-center">
                        <p class="text-sm uppercase tracking-wider text-gray-600 font-semibold mb-2">Date:</p>
                        <div class="h-24 border-t-2 border-gray-400 pt-8">
                            <p class="font-serif font-bold text-xl">December 15, 2024</p>
                        </div>
                    </div>

                    <!-- Principal -->
                    <div class="text-center md:text-right">
                        <p class="text-sm uppercase tracking-wider text-gray-600 font-semibold mb-2">Certified by:</p>
                        <div class="h-24 border-t-2 border-gray-400 pt-4">
                            <p class="font-serif font-bold text-lg">DR. JOSE RIZAL</p>
                            <p class="text-sm font-medium text-gray-600">School Principal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Footer -->
        <div class="mt-16 pt-8 border-t-4 border-dashed border-amber-600/30 text-center">
            <p class="text-xs uppercase tracking-widest font-bold text-gray-500 italic">
                Official Certificate • Not Valid for Legal Purposes
            </p>
        </div>
    </div>
</body>

</html>