<x-layout>

    <style>
        /* ─── seller / MEMBERSHIP ─── */
        .seller-contact-section {
            width: 100%;
            padding: 80px 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .seller-contact-inner {
            width: 100%;
            max-width: 42rem;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .seller-contact-header {
            width: 100%;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .seller-contact-sub {
            font-size: 0.875rem;
            font-weight: 300;
            margin-top: 0.75rem;
            max-width: 20rem;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.625;
            color: var(--secondary);
        }

        .seller-contact-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .seller-contact-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 767px) {
            .seller-contact-form-row {
                grid-template-columns: 1fr;
            }
        }

        .seller-contact-card {
            width: 100%;
            padding: 2rem 1.5rem;
            position: relative;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(73, 54, 40, 0.08), 0 8px 10px -6px rgba(73, 54, 40, 0.06);
            background: var(--cream);
            border: 1px solid var(--accent);
        }

        .seller-contact-card-title {
            font-size: 0.75rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--secondary);
        }

        .seller-contact-footer {
            text-align: center;
            font-size: 0.75rem;
            margin-top: 1.5rem;
            color: var(--secondary);
        }

        .input-group {
            position: relative;
        }

        .input-group input,
        .input-group textarea {
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
        }

        .input-group label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.875rem;
            color: var(--secondary);
            pointer-events: none;
            transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
            background: transparent;
            padding: 0 0.25rem;
        }

        .input-group.textarea-group label {
            top: 1.1rem;
            transform: none;
        }

        .input-group input:focus~label,
        .input-group input:not(:placeholder-shown)~label,
        .input-group textarea:focus~label,
        .input-group textarea:not(:placeholder-shown)~label {
            top: -0.55rem;
            font-size: 0.72rem;
            color: var(--primary);
            background: var(--cream);
            font-weight: 500;
            letter-spacing: 0.04em;
        }

        /* Input focus ring */
        .custom-input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.18);
            background: #fff;
        }

        .custom-input {
            border: 1.5px solid var(--accent);
            background: var(--cream);
            color: var(--dark);
            border-radius: 0.625rem;
            width: 100%;
            padding: 0.85rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
        }

        .custom-input::placeholder {
            color: transparent;
        }

        .custom-input:hover {
            border-color: var(--secondary);
        }

        /* Icon pulse on focus */
        .input-group:focus-within .icon-wrap {
            color: var(--primary);
            transform: scale(1.15);
        }

        .icon-wrap {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            transition: color 0.25s, transform 0.25s;
            pointer-events: none;
        }

        .textarea-group .icon-wrap {
            top: 1.05rem;
            transform: none;
        }

        .textarea-group:focus-within .icon-wrap {
            transform: none;
        }

        /* Submit button shimmer */
        .btn-submit {
            position: relative;
            overflow: hidden;
            background: var(--primary);
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.82rem;
            padding: 0.95rem 2.5rem;
            border-radius: 0.625rem;
            border: none;
            cursor: pointer;
            transition: background 0.3s, transform 0.18s;
            width: 100%;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.13), transparent);
            transition: left 0.55s ease;
        }

        .btn-submit:hover::after {
            left: 160%;
        }

        .btn-submit:hover {
            background: var(--dark);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        /* Card entrance */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slide-up {
            animation: slideUp 0.65s cubic-bezier(.22, 1, .36, 1) both;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease both;
        }

        .delay-100 {
            animation-delay: 0.10s;
        }

        .delay-200 {
            animation-delay: 0.20s;
        }

        .delay-300 {
            animation-delay: 0.30s;
        }

        .delay-400 {
            animation-delay: 0.40s;
        }

        .delay-500 {
            animation-delay: 0.50s;
        }

        .delay-600 {
            animation-delay: 0.60s;
        }



        /* Scrollbar hide for textarea */
        textarea.custom-input {
            resize: none;
        }

        /* Subtle pattern bg on section */
        .section-bg {
            background-color: var(--background);
            background-image:
                radial-gradient(circle at 20% 20%, rgba(171, 136, 109, 0.10) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(73, 54, 40, 0.08) 0%, transparent 50%);
        }

        /* Corner ornament */
        .ornament {
            width: 48px;
            height: 48px;
            border-top: 2px solid var(--secondary);
            border-left: 2px solid var(--secondary);
            border-radius: 4px 0 0 0;
        }

        .ornament-br {
            border-top: none;
            border-left: none;
            border-bottom: 2px solid var(--secondary);
            border-right: 2px solid var(--secondary);
            border-radius: 0 0 4px 0;
        }

        /* Badge pill */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.7rem;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            background: rgba(171, 136, 109, 0.15);
            color: var(--primary);
            border: 1px solid rgba(171, 136, 109, 0.35);
            padding: 0.3rem 0.9rem;
            border-radius: 999px;
        }

        /* Select input */
        select.custom-input {
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
        }

        /* Checkbox style */
        .custom-check {
            accent-color: var(--primary);
            width: 1rem;
            height: 1rem;
            cursor: pointer;
        }

        /* Step indicator dots */
        .step-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            transition: background 0.3s, transform 0.3s;
        }

        .step-dot.active {
            background: var(--primary);
            transform: scale(1.35);
        }

        /* File upload fields — label always floated on border */
        .input-group.file-group {
            padding-top: 0.35rem;
        }

        .input-group.file-group > label {
            top: -0.2rem;
            transform: none;
            font-size: 0.72rem;
            color: var(--primary);
            background: var(--cream);
            font-weight: 500;
            letter-spacing: 0.04em;
            z-index: 2;
        }

        .file-drop {
            position: relative;
        }

        .file-drop input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .file-drop-ui {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            pointer-events: none;
            min-height: 3.05rem;
            padding-right: 2.5rem;
        }

        .file-drop-ui .file-name {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 0.875rem;
            color: var(--secondary);
            text-align: left;
        }

        .file-drop-ui .file-name.has-file {
            color: var(--dark);
            font-weight: 500;
        }

        .file-group:focus-within .custom-input {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.18);
            background: #fff;
        }

        .file-group:focus-within .icon-wrap {
            color: var(--primary);
            transform: translateY(-50%) scale(1.15);
        }

        /* Image preview after upload */
        .file-preview {
            display: none;
            margin-top: 0.75rem;
            position: relative;
            border-radius: 0.625rem;
            overflow: hidden;
            border: 1.5px solid var(--accent);
            background: #fff;
            aspect-ratio: 16 / 10;
            max-height: 9rem;
        }

        .file-preview.is-visible {
            display: block;
            animation: fadeIn 0.35s ease both;
        }

        .file-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .file-preview-clear {
            position: absolute;
            top: 0.45rem;
            right: 0.45rem;
            width: 1.65rem;
            height: 1.65rem;
            border-radius: 999px;
            border: none;
            background: rgba(73, 54, 40, 0.85);
            color: var(--cream);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            z-index: 4;
            transition: background 0.2s, transform 0.2s;
        }

        .file-preview-clear:hover {
            background: var(--dark);
            transform: scale(1.08);
        }
    </style>
    <!-- ─── Seller Contact Information ─── -->
    <section class="seller-contact-section">
        <div class="seller-contact-inner animate-fade-in">
            <!-- Section header -->
            <div class="seller-contact-header animate-slide-up">
                <span class="badge mb-4">
                    <i class="fa-solid fa-circle text-[6px] text-[#AB886D]"></i>
                    New Membership
                </span>

                <h2 class="font-display text-4xl font-bold mt-3 mb-2" style="color: var(--dark); line-height:1.2;">
                    Register Your<br />
                    <span style="color: var(--secondary); font-style: italic;">Shop</span>
                </h2>

                <p class="seller-contact-sub">
                    Join our curated community of artisan shop owners and start your journey today.
                </p>
            </div>

            <!-- Card -->
            <div class="seller-contact-card animate-slide-up delay-200">

                <!-- Form title inside card -->
                <p class="seller-contact-card-title animate-slide-up delay-300">Personal &amp; Shop Details</p>

                <form action="{{ route('seller.request') }}" method="POST" novalidate class="seller-contact-form"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="input-group animate-slide-up delay-300">
                        <input type="text" name="name" id="name" placeholder="Full Name" autocomplete="name"
                            class="custom-input pr-10" required />
                        <label for="name">Full Name</label>
                        <span class="icon-wrap">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="input-group animate-slide-up delay-400">
                        <input type="email" name="email" id="email" placeholder="Email Address"
                            autocomplete="email" class="custom-input pr-10" required />
                        <label for="email">Email Address</label>
                        <span class="icon-wrap">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </span>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Two-column row: Shop Name + Contact -->
                    <div class="seller-contact-form-row">
                        <!-- Registration Number -->
                        <div class="input-group animate-slide-up delay-550">
                            <input type="text" name="registration_number" id="registration_number"
                                placeholder="Registration Number" autocomplete="off" class="custom-input pr-10"
                                required />
                            <label for="registration_number">Registration Number</label>
                            <span class="icon-wrap">
                                <i class="fa-solid fa-file-lines text-sm"></i>
                            </span>
                            @error('registration_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Contact -->
                        <div class="input-group animate-slide-up delay-500">
                            <input type="tel" name="contact" id="contact" placeholder="Contact Number"
                                autocomplete="tel" class="custom-input pr-10" required />
                            <label for="contact">Contact Number</label>
                            <span class="icon-wrap">
                                <i class="fa-solid fa-phone text-sm"></i>
                            </span>
                            @error('contact')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Shop Name -->
                    <div class="input-group animate-slide-up delay-500">
                        <input type="text" name="shop_name" id="shop_name" placeholder="Shop Name"
                            autocomplete="organization" class="custom-input pr-10" required />
                        <label for="shop_name">Shop Name</label>
                        <span class="icon-wrap">
                            <i class="fa-solid fa-store text-sm"></i>
                        </span>
                        @error('shop_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Two-column row: Citizenship Photo + PAN/Company Image -->
                    <div class="seller-contact-form-row">

                        <!-- Citizenship Photo -->
                        <div class="input-group file-group animate-slide-up delay-600">
                            <div class="file-drop">
                                <input type="file" name="citizenship_photo" id="citizenship_photo"
                                    accept="image/jpeg,image/png,image/jpg,image/gif" required
                                    onchange="previewUpload(this, 'citizenship_label', 'citizenship_preview', 'citizenship_preview_img', 'Upload citizenship photo')" />
                                <div class="custom-input file-drop-ui">
                                    <span id="citizenship_label" class="file-name">Upload citizenship photo</span>
                                </div>
                                <span class="icon-wrap">
                                    <i class="fa-solid fa-upload text-sm"></i>
                                </span>
                            </div>
                            <label for="citizenship_photo">Citizenship Photo</label>
                            <div id="citizenship_preview" class="file-preview">
                                <img id="citizenship_preview_img" alt="Citizenship photo preview" />
                                <button type="button" class="file-preview-clear" aria-label="Remove citizenship photo"
                                    onclick="clearUpload('citizenship_photo', 'citizenship_label', 'citizenship_preview', 'citizenship_preview_img', 'Upload citizenship photo')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            @error('citizenship_photo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company / PAN Registration -->
                        <div class="input-group file-group animate-slide-up delay-600">
                            <div class="file-drop">
                                <input type="file" name="image" id="image"
                                    accept="image/jpeg,image/png,image/jpg,image/gif" required
                                    onchange="previewUpload(this, 'pan_label', 'pan_preview', 'pan_preview_img', 'Upload PAN / registration')" />
                                <div class="custom-input file-drop-ui">
                                    <span id="pan_label" class="file-name">Upload PAN / registration</span>
                                </div>
                                <span class="icon-wrap">
                                    <i class="fa-regular fa-file-lines text-sm"></i>
                                </span>
                            </div>
                            <label for="image">PAN / Company Registration</label>
                            <div id="pan_preview" class="file-preview">
                                <img id="pan_preview_img" alt="PAN / company registration preview" />
                                <button type="button" class="file-preview-clear" aria-label="Remove PAN image"
                                    onclick="clearUpload('image', 'pan_label', 'pan_preview', 'pan_preview_img', 'Upload PAN / registration')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2 animate-slide-up delay-700">
                        <button type="submit" class="btn-submit">
                            <span class="flex items-center justify-center gap-2">
                                Register Shop
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </span>
                        </button>
                    </div>

                </form>
            </div>
            <!-- Bottom caption -->
            <p class="seller-contact-footer animate-fade-in delay-600">
                🔒 Your information is encrypted &amp; secure.
            </p>
        </div>
    </section>

    <script>
        function previewUpload(input, labelId, previewId, imgId, placeholder) {
            const label = document.getElementById(labelId);
            const preview = document.getElementById(previewId);
            const img = document.getElementById(imgId);
            const file = input.files[0];

            if (file && file.type.startsWith('image/')) {
                label.textContent = file.name;
                label.classList.add('has-file');

                const reader = new FileReader();
                reader.onload = function (e) {
                    img.src = e.target.result;
                    preview.classList.add('is-visible');
                };
                reader.readAsDataURL(file);
            } else {
                clearUpload(input.id, labelId, previewId, imgId, placeholder);
            }
        }

        function clearUpload(inputId, labelId, previewId, imgId, placeholder) {
            const input = document.getElementById(inputId);
            const label = document.getElementById(labelId);
            const preview = document.getElementById(previewId);
            const img = document.getElementById(imgId);

            input.value = '';
            label.textContent = placeholder;
            label.classList.remove('has-file');
            img.removeAttribute('src');
            preview.classList.remove('is-visible');
        }
    </script>
</x-layout>
