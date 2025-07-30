  <footer class="footer sm:footer-horizontal bg-[#2e2f3c] text-base-content p-10 text-white">
    <!-- Quicklinks Column -->
    <nav>
      <h6 class="footer-title">Quicklinks</h6>
      <a href="{{ route('home') }}" class="link link-hover">Home</a>
      <a href="{{ route('about') }}" class="link link-hover">About us</a>
      <a href="{{ route('service') }}" class="link link-hover">Service</a>
      <a href="#" class="link link-hover">Blog</a>
      <a href="{{ route('contact') }}" class="link link-hover">Contact</a>
      <div class="dropdown dropdown-hover">
        <div tabindex="0" role="button" class="link flex items-center gap-2 cursor-pointer">
          Portofolio
          <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M5.25 7.75L10 12.5l4.75-4.75z" />
          </svg>
        </div>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-[#2e2f3c] rounded-box w-52">
          <li><a href="#" class="hover:bg-[#ff0000] hover:text-white">Portofolio Design</a></li>
        </ul>
      </div>
    </nav>

    <!-- Contacts Column -->
    <nav>
      <h6 class="footer-title">Contacts</h6>
      <a href="https://maps.app.goo.gl/1XyAXggZZavMJx3C8" class="link link-hover">
        Town House Buana Central Park Blok Lexington No. 112 B, Kota Batam, Kep. Riau.
      </a>
      <a href="mailto:i.d.project.official01@gmail.com" class="link link-hover">
        i.d.project.official01@gmail.com
      </a>
      <a href="https://api.whatsapp.com/send/?phone=628116585494&text&type=phone_number&app_absent=0" class="link link-hover">
        0778 - 3852963 / 0895 - 3149 - 8443
      </a>
    </nav>

    <!-- Legal Column -->
    <nav>
      <h6 class="footer-title">Legal</h6>
      <a href="#" class="link link-hover">Terms and conditions</a>
      <a href="#" class="link link-hover">Privacy policy</a>
    </nav>

    <!-- Social Links Column -->
    <nav>
      <h6 class="footer-title">Social Links</h6>
      <div class="grid grid-flow-col gap-4">
        <a href="https://www.facebook.com/apriliane.fress" class="bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200 transition-colors w-10 h-10 flex items-center justify-center">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com/id.project.official" class="bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200 transition-colors w-10 h-10 flex items-center justify-center">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/@ID.PROJECTOFFICIAL" class="bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200 transition-colors w-10 h-10 flex items-center justify-center">
          <i class="fab fa-youtube"></i>
        </a>
        <a href="https://www.tiktok.com/@id.project.official" class="bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200 transition-colors w-10 h-10 flex items-center justify-center">
          <i class="fab fa-tiktok"></i>
        </a>
      </div>
    </nav>
  </footer>

  <!-- Copyright -->
  <div class="bg-[#2e2f3c] text-gray-400 text-center py-4">
    Copyright © {{ date('Y') }}. PBL IF 05 :3.
  </div>