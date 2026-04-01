       <dialog id="add_cert" class="modal">
           <div class="modal-box bg-white w-11/12 max-w-5xl">
               <h3 class="text-lg font-bold">Hello!</h3>

               <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                   <input id="brgy" type="text" placeholder="Barangay" class="input bg-white" />
                   <select id="selected-official" class="bg-white select">
                       <option disabled selected>Pick a color</option>
                       <option>Okiot</option>
                       <option>Amber</option>
                       <option>Velvet</option>
                   </select>
               </div>

               <div class="modal-action">
                   <button onclick="addBrgy()" class="flex float-right items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                       <span>Add</span>
                   </button>
                   <form method="dialog" class="">
                       <!-- if there is a button, it will close the modal -->
                       <button class="flex float-right items-center gap-2 px-5 py-2 rounded-lg bg-red-600 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                           <span>Cancel</span>
                       </button>
                   </form>
               </div>
           </div>
       </dialog>


       <div class="md:p-10 w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 pl-6 space-y-8">
           <!-- Welcome Section -->
           <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
               <div class="">
                   <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Barangay</h1>
                   <p class="text-slate-500 font-poppins">Certificates</p>
               </div>
               <div class="flex items-center gap-3">
                   <button onclick="createCert()" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                       <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                       <span>Add Certificate</span>
                   </button>
               </div>
           </div>

       </div>


       <section class="px-8 py-10">
           <div class=" p-5 relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 border border-gray-300" id="--add-cert">
               <section class="text-gray-600 body-font">
                   <div class="container px-5 mx-auto">
                       <div class="flex flex-wrap -m-4">
                           <div class="p-4 lg:w-1/3">
                               <div class="h-full bg-gray-100 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative border border-gray-300">
                                   <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">Certification</h2>
                                   <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">Embalming</h1>
                                   <a class="text-indigo-500 inline-flex items-center">View
                                       <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                           <path d="M5 12h14"></path>
                                           <path d="M12 5l7 7-7 7"></path>
                                       </svg>
                                   </a>
                                   <div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">
                                       <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                           <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                               <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                               <circle cx="12" cy="12" r="3"></circle>
                                           </svg>1.2K
                                       </span>
                                       <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                           <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                               <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                           </svg>6
                                       </span>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </section>
           </div>
       </section>