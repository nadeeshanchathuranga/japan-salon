<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CHERISH｜福岡のデトックスサロン｜水素吸入・足湯・岩盤浴</title>
      <meta name="keywords" content="CHERISH, デトックスサロン, 福岡サロン, 水素吸入, 足湯, 岩盤浴, 心と体ケア, リラクゼーション, ヒーリング, 自分時間">
      <meta name="description" content="福岡のデトックスサロンCHERISH。水素吸入・天然鉱石の足湯・低温岩盤浴で心と体を癒し、自分を大切にする時間をご提供します。">
      <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
      <!-- Bootstrap 5 CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
      <link href="{{ asset('css/lightbox.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/hover.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('css/mobile-style.css') }}" rel="stylesheet">
   </head>
   <body>
      <div class="container-fluid header-section" id="home">
         <div class="row align-items-center ">
            <div class="col-lg-2 col-sm-4 col-4">
               <a href="{{ route('home') }}" title="CHERISH | Home Page">
               <img src="{{ asset('/images/logo.png') }}" class="w-75 mx-auto"
                  alt="The Blue Lotus Meditation Center">
               </a>
            </div>
            <div class="col-lg-10  ">
               <nav class="navbar navbar-expand-lg navbar-light  ">
                  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                     aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav mx-auto navbar-custom">
                        <li class="nav-item">
                           <a class="nav-link active font-18 jost-font text-white fw-bolder ps-lg-5 ps-sm-4 ps-2"
                              aria-current="page" href="#home">ホーム</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-18 jost-font text-white fw-bolder ps-lg-5 ps-sm-4 ps-2"
                              href="#about">私たちについて</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-18 jost-font text-white fw-bolder ps-lg-5 ps-sm-4 ps-2"
                              href="#services">サービス一覧</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-18 jost-font text-white fw-bolder ps-lg-5 ps-sm-4 ps-2"
                              href="#story">Cherish のストーリー</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-18 jost-font text-white fw-bolder ps-lg-5 ps-sm-4 ps-2"
                              href="#contact">お問い合わせ</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
      </div>
      <div class="container-fluid slider-section  ">
         <div class="row align-items-center ">
            <div class="col-12 px-0">
               <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <img src="{{ asset('/images/salon-banner.png') }}" class="d-block w-100" alt="Cherish">
                        <div class="carousel-caption  ">
                           <h3 class="font-144 fw-bold kiwi-maru-font text-second ls-2">CHERISH</span>
                           </h3>
                           <h3 class="font-48 pt-2 jost-font text-white fw-bolder">デトックスサロン</span>
                           </h3>
                           <h3 class="font-27 pt-2 py-2 fst-italic jost-font text-white fw-bolder">心と体をゆるめ、緩めて、明日に繋ぐ場所</span>
                           </h3>
                           <ul class="d-flex justify-content-center list-unstyled gap-5 pt-lg-3 pt-1">
                              <li><a href="https://beauty.hotpepper.jp/" target="_blank"
                                 class="btn-border-1 jost-font font-20 text-white fw-bolder px-lg-5 px-2 py-lg-3 py-1 bt-hvr hvr-grow ">ご予約はこちら</a>
                              </li>
                              {{--
                              <li><a href="" class="btn-border-1 jost-font font-17 fw-bolder px-5 py-2 bt-hvr hvr-grow">サービス一覧</a></li>
                              --}}
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container compny-details d-none  d-lg-block  d-xl-none">
            <div class="row justify-content-center text-center">
               <div class="col-lg-4 mb-4">
                  <h4 class="font-18 fw-bold text-white text-uppercase jost-font ls-1 pb-4">CONTACT</h4>
                  <p class="fw-normal jost-font font-16 pb-1"> <a href="tel:080XXXXXXXX" class="text-white">080 XXXX XXXX</a>
                  </p>
                  <p class="fw-normal jost-font font-16"><a href="mailto:cherish.fukuoka260101@gmail.com"
                     class="text-white">cherish.fukuoka260101@gmail.com</a></p>
               </div>
               <div class="col-lg-4 mb-4">
                  <h4 class="font-18 fw-bold text-white text-uppercase jost-font ls-1 pb-4">HOURS</h4>
                  <p class="fw-normal jost-font font-16 pb-1 text-white">Mon to Fri: 7:30 am — 1:00 am </p>
                  <p class="fw-normal jost-font font-16 pb-1 text-white">Sat: 9:00 am — 1:00 am</p>
                  <p class="fw-normal jost-font font-16 pb-1 text-white">Sun: 9:00 am — 11:30 pm</p>
               </div>
               <div class="col-lg-4 mb-4">
                  <h4 class="font-18 fw-bold text-white text-uppercase jost-font ls-1 pb-4">LOCATION</h4>
                  <p class="fw-normal jost-font font-16 pb-1 text-white">1-chōme-206</p>
                  <p class="fw-normal jost-font font-16 pb-1 text-white">Hikida, Kanazawa, Ishikawa</p>
                  <p class="fw-normal jost-font font-16 pb-1 text-white">920-0003, Japan</p>
               </div>
            </div>
         </div>
      </div>
      <section id="about" class="py-5 bg-main">
         <div class="container py-lg-4 py-sm-3">
            <!-- Heading -->
            <div class="row align-items-center g-4 g-lg-5 jost-font text-main ">
               <div class="col-lg-6">
                  <h1 class="font-54 fw-bold mb-4">私たちについて</h1>
                  <ul class="custom-bullets mb-4 font-14">
                     <li class="d-flex mb-2">
                        <strong>カラダ</strong> → 水素吸入や天然鉱石を使った足湯、低温の岩盤浴などを組み合わせてデトックス
                     </li>
                     <li class="d-flex mb-2">
                        <strong>ココロ</strong> → ご自身が選ばれた色をもとに、お話を聞き、今やちょっと先の未来を生きやすくするための後押し
                     </li>
                  </ul>
                  <p class="font-14 fw-bolder pb-1">
                     様々な環境や立場で頑張っている方や、人間関係に疲れを感じている方に、“自分を大切にする時間”を過ごしてほしい
                  </p>
               </div>
               <!-- Image / media -->
               <div class="col-lg-6">
                  <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
                     <img src="{{ asset('/images/about-us.jpg') }}" alt="Our team collaborating in the studio"
                        class="w-100 h-100 object-fit-cover">
                  </div>
               </div>
            </div>
            <div class="row justify-content-center pt-5">
               <div class="col-lg-6 col-sm-7 jost-font text-main pt-lg-0 pt-sm-0 pt-3">
                  <h2 class="font-40 fw-bold pb-3 text-center">ご利用の流れ</h2>
                  <table class="table table-bordered table-striped  align-middle font-14">
                     <thead class="table-dark">
                        <tr>
                           <th>コース</th>
                           <th>内容</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1時間コース</td>
                           <td>着替え → 足湯（60分） → 着替え</td>
                        </tr>
                        <tr>
                           <td>2時間コース</td>
                           <td>着替え → 足湯（60分） → 岩盤浴（60分） → 着替え</td>
                        </tr>
                     </tbody>
                  </table>
                  <p class="font-15 fw-bolder pb-2">※いずれのコースもタオル・コース中の着替え完備。
                     シャワー利用も可能。
                  </p>
               </div>
            </div>
         </div>
      </section>
      <div class="container-fluid service-section py-5 bg-white" id="services">
         <div class="container py-5">
            <div class="row align-items-center ">
               <div class="col-12 jost-font text-main text-center mx-auto">
                  <h2 class="font-40 fw-bold pb-lg-5 pb-sm-5 pb-3">サービス一覧</h2>
                  {{--
                  <ul class="d-flex justify-content-center list-unstyled gap-5 font-24 text-main py-3 text-center">
                     <li>
                        <img
                           src="{{asset('/images/1.png')}}"
                           class="w-auto mx-auto" alt="CHERISH">
                        <div class="font-17 fw-bolder pt-2  ls-1">Facial</div>
                     </li>
                     <li>
                        <img  src="{{asset('/images/2.png')}}"class="w-auto mx-auto" alt="CHERISH">
                        <div class="font-17 fw-bolder pt-2  ls-1">Skincare</div>
                     </li>
                     <li>
                        <img  src="{{asset('/images/3.png')}}" class="w-auto mx-auto" alt="CHERISH">
                        <div class="font-17 fw-bolder pt-2  ls-1">manicure pedicure</div>
                     </li>
                     <li>
                        <img  src="{{asset('/images/4.png')}}" class="w-auto mx-auto" alt="CHERISH">
                        <div class="font-17 fw-bolder pt-2  ls-1">Makeup</div>
                     </li>
                     <li>
                        <img  src="{{asset('/images/5.png')}}"class="w-auto mx-auto" alt="CHERISH">
                        <div class="font-17 fw-bolder pt-2  ls-1">Hair</div>
                     </li>
                  </ul>
                  --}}
                  @php
                  $useSlider = $services->count() > 3;
                  @endphp
                  @if ($useSlider)
                  <div class="owl-carousel service-carousel">
                     @foreach ($services as $service)
                     <div class="item px-1">
                        {{-- px-1 gives small gap between cards --}}
                        <div class="card h-100 shadow-sm rounded-3">
                           {{-- Image box (200px height, cover) --}}
                           <div class="w-100" style="height:200px;">
                              @php
                              $img = $service->image_path
                              ? asset('storage/' . $service->image_path)
                              : asset('/images/service.jpg');
                              @endphp
                              <img src="{{ $img }}" alt="{{ $service->title }}"
                                 class="w-100" style="width:100%; height:100%; object-fit:cover;">
                           </div>
                           <div class="card-body">
                              <h5 class="fw-bold mb-2">{{ $service->title }}</h5>
                              <p class="mb-0 text-muted">
                                 {{ \Illuminate\Support\Str::limit($service->description ?? '—', 90) }}
                              </p>
                           </div>
                           <div
                              class="card-footer d-flex justify-content-between align-items-center bg-white">
                              <div class="d-flex align-items-center gap-2">
                                 <span
                                    class="fw-bolder">¥{{ number_format($service->price, 2) }}</span>
                                 @unless ($service->is_active)
                                 <span class="badge bg-secondary">Inactive</span>
                                 @endunless
                              </div>
                              <a href="https://beauty.hotpepper.jp/" target="_blank"
                                 class="py-2 px-4 btn-border fw-bold text-center hvr-grow">
                              Book
                              </a>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  @else
                  {{-- Fallback grid when <= 3 items --}}
                  <div class="row g-4">
                     @if ($services->count() > 0)
                     @foreach ($services as $service)
                     <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-3">
                           <div class="w-100" style="height:200px;">
                              @php
                              $img = $service->image_path
                              ? asset('storage/' . $service->image_path)
                              : asset('/images/service.jpg');
                              @endphp
                              <img src="{{ $img }}" alt="{{ $service->title }}"
                                 class="w-100" style="width:100%; height:100%; object-fit:cover;">
                           </div>
                           <div class="card-body">
                              <h5 class="fw-bold mb-2">{{ $service->title }}</h5>
                              <p class="mb-0 text-muted">
                                 {{ \Illuminate\Support\Str::limit($service->description ?? '—', 90) }}
                              </p>
                           </div>
                           <div
                              class="card-footer d-flex justify-content-between align-items-center bg-white">
                              <div class="d-flex align-items-center gap-2">
                                 <span
                                    class="fw-bolder">¥{{ number_format($service->price, 2) }}</span>
                                 @unless ($service->is_active)
                                 <span class="badge bg-secondary">Inactive</span>
                                 @endunless
                              </div>
                              <a href="https://beauty.hotpepper.jp/" target="_blank"
                                 class="py-2 px-4 btn-border fw-bold text-center hvr-grow">
                              Book
                              </a>
                           </div>
                        </div>
                     </div>
                     @endforeach
                     @else
                     <div class="col-12">
                        <div class="alert alert-info mb-0 font-16 fw-normal">No services found.</div>
                     </div>
                     @endif
                  </div>
                  @endif
               </div>
               <!-- <p class="font-16 fw-normal py-3">We started as a small beauty studio in Pakistan. Our main idea was
                  to create the best beauty studio in the world. Can there be compromises in the best studio in
                  the world? Our answer is always no, we care about the best quality, we hire the best specialists
                  and provide the best customer service. This approach allowed us to grow and create awesome team
                  that is passionate about everything we do.
                  </p>
                  <p class="pt-4 ">
                  <a href="" class="py-2 px-5 btn-border font-16 fw-bold text-center hvr-bounce-to-right">View サービス一覧</a>
                  </p> -->
            </div>
         </div>
      </div>
      <div class="container-fluid story-section py-5 bg-main"  id="story">
         <div class="container pt-3 pb-5">
            <div class="row align-items-center pb-lg-5">
               <!-- <div class="col-lg-6  col-12">
                  <img src="{{ asset('/images/coming-soon.png') }}" class="w-100" alt="CHERISH">
                  </div> -->
               <div class=" col-lg-8 col-sm-10 mx-auto text-start jost-font text-main">
                  <h1 class="font-40 fw-bold pb-3 text-center pb-4">CHERISH（チェリッシュ）について</h1>
                  <p class="fw-normal jost-font font-16 mb-2">
                     CHERISH（チェリッシュ）は、がんばりすぎてしまう毎日の中で
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     <strong>「自分を大切にできる場所をつくりたい」</strong>
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     そんな思いから生まれました。
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     わたしたちは、水素吸入と天然鉱石を使った足湯や低温の岩盤浴サウナを掛け合わせ、デトックスを行い、
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     色彩心理カウンセリングなどを通して、ココロに目を向ける。
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     心と身体を静かにゆるめるための、穏やかな時間を過ごす
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     <strong>“自分を大切にする習慣”</strong>
                  </p>
                  <p class="fw-normal jost-font font-16 mb-2">
                     を届けています。
                  </p>
                  <h2  class="font-30 fw-bold pb-3 text-center pt-2 pb-4">CHERISH が大切にしていること</h2>
                  <ul class="custom-bullets">
                     <li class="mb-4">
                        <span class="fw-bold text-main d-block mb-2">【日常に寄り添うデトックス】</span>
                        <p class="fw-normal jost-font font-16 mb-0">
                           無理なく通える価格と時間で、続けられるケアを。
                        </p>
                     </li>
                     <li class="mb-4">
                        <span class="fw-bold text-main d-block mb-2">【本物に触れる安心感】</span>
                        <p class="fw-normal jost-font font-16 mb-0">
                           厳選した機器や天然鉱石を導入し、質を落とさず心地よさを追求。
                        </p>
                     </li>
                     <li class="mb-4">
                        <span class="fw-bold text-main d-block mb-2">【心も身体も緩める空間】</span>
                        <p class="fw-normal jost-font font-16 mb-0">
                           忙しい日常から少し離れて、素の自分に戻れるような場所に。
                        </p>
                     </li>
                     <li class="mb-4">
                        <span class="fw-bold text-main d-block mb-2">【名前に込めた想い】</span>
                        <p class="fw-normal jost-font font-16 mb-2">
                           CHERISH＝大切にする、愛おしむ。
                        </p>
                        <p class="fw-normal jost-font font-16 mb-2">
                           ここで過ごす時間が「自分を大切にするきっかけ」となり、
                        </p>
                        <p class="fw-normal jost-font font-16 mb-0">
                           その優しさがまた周りの人へも広がっていくことを願っています。
                        </p>
                     </li>
                  </ul>
                  <div class="cherish-message">
                     <p class="fw-bolder jost-font font-18 pb-2">
                        CHERISHは、訪れるたびに「また明日も頑張ろう」と思えるような
                     </p>
                     <p class="fw-bolder jost-font font-18 pb-2">
                        心と身体のリセット空間を目指しています。
                     </p>
                     <p class="fw-bolder jost-font font-18 pb-2">
                        初めて来てくださる方も、何度も通ってくださる方も、
                     </p>
                     <p class="fw-bolder jost-font font-18 pb-2">
                        「ここに来ると整う」と感じていただけるように。
                     </p>
                     <p class="fw-bolder jost-font font-18 pb-2">
                        ここから、あなた自身の物語がまた新しく始まりますように。
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid seen-section">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-9 mx-auto text-main">
                  <h2 class="font-48 fw-bold pb-4 jost-font">メディア掲載</h2>
                  <p class="font-30 kiwi-maru-font fw-normal lh-lg">
                     "常に高い品質と心のこもったサービス、そして洗練されたスタイルが魅力の場所"
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid follow-section py-5 " id="contact">
         <div class="container  ">
            <div class="row align-items-center ">
               <div class="col-lg-5 col-sm-5 col-8 mx-auto">
                  <img src="{{ asset('/images/log02.png') }}" class="w-100" alt="CHERISH">
               </div>
               <div class="col-lg-2 col-sm-2 gradient-bar"></div>
               <div class="col-lg-5 col-sm-5 jost-font text-center">
                  <h2 class="font-40 fw-bold pb-3">お問い合わせ</h2>
                  <div class="row">
                     <div class="col-lg-8  mx-auto">
                        <p class="font-18 fw-normal pb-2">お得なキャンペーン情報をお見逃しなく！最新ニュースを知りたい方は、ぜひフォローしてください。
                        </p>
                        <ul class="d-flex justify-content-center list-unstyled gap-4 font-24 text-main pt-3">
                           <li><a href="https://www.tiktok.com/@cherish_fukuoka" target="_blank"
                              class="hvr-grow"><i class="fa-brands fa-tiktok text-main fs-3"></i></a></li>
                           <li><a href="https://www.youtube.com/channel/UCJwlS_qkGUo_bL4dA5wQ6oQ" target="_blank"
                              class="hvr-grow"><i class="fa-brands fa-youtube text-main fs-3"></i></a></li>
                           <li><a href="https://www.instagram.com/cherish20260110" target="_blank"
                              class="hvr-grow"><i class="fa-brands fa-instagram text-main fs-3"></i></a></li>
                           <li>
                              <a href="https://line.me/R/ti/p/@447flqxy" target="_blank" class="hvr-grow">
                              <i class="fa-brands fa-line text-main fs-3"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{--
      <div class="container-fluid gallery-container py-5 bg-main">
         <div class="row pt-3 pb-4">
            <div class="col-12 section-d-top">
               <h2 class="font-40 fw-bold pb-lg-5 pb-sm-5 pb-3 jost-font text-main text-center">Gallery</h2>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-1.png')}}"   data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-1.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-2.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-2.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-3.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-3.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-4.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-4.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-8.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-8.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-5.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-5.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-6.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-6.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-6 col-sm-3 px-0">
               <div class="hovereffect">
                  <a href="{{asset('/images/gallery-7.png')}}" data-lightbox="gallery" data-title="Image caption">
                     <img src="{{asset('/images/gallery-7.png')}}" class="img-fluid w-100" alt="CHERISH">
                     <div class="overlay">
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </div>
      --}}
      <div class="container-fluid location-section py-5">
         <div class="row align-items-center pt-4">
            <div class="col-12 mx-auto text-center text-second px-0">
               <h2 class="font-40 fw-bold pb-lg-5 pb-sm-5 pb-3 jost-font">Location</h2>
               <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6647.305909362275!2d130.32580865!3d33.588358899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3541934099601119%3A0xfc2cb57b0e25ebb1!2sMeinohama%2C%20Nishi%20Ward%2C%20Fukuoka%2C%20819-0002%2C%20Japan!5e0!3m2!1sen!2slk!4v1758356493580!5m2!1sen!2slk"
                  class="map" style="border:0;" allowfullscreen="" loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
         </div>
      </div>
      <div class="container-fluid service-section py-5 bg-main">
         <div class="container py-lg-5  py-sm-5">
            <div class="row align-items-center ">
               <div class="col-12 jost-font text-main text-center mx-auto">
                  <h2 class="font-40 fw-bold"> 
                     お客様の声
                  </h2>
                   

<div class="row g-4">
  <div class="col-sm-12">
    <div id="customers-testimonials" class="owl-carousel" role="region"
         aria-roledescription="carousel" aria-label="Testimonials">
      @foreach ($testimonials as $testimonial)
        <div class="item" aria-roledescription="slide">
          <div class="shadow-effect">
            <img class="img-circle"
                 src="{{ $testimonial->image_path ? asset('storage/' . $testimonial->image_path) : asset('images/default.png') }}"
                 alt="Photo of {{ $testimonial->name ?? 'User' }}">
            <p class="font-15 fw-bolder pb-2">{{ $testimonial->content }}</p>
          </div>
          <div class="testimonial-name">{{ $testimonial->name }}</div>
        </div>
      @endforeach
    </div>
  </div>
</div>


                  
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid opening-section py-5 bg-white">
         <div class="row  py-3 text-center text-main">
            <div class="col-lg-4 col-sm-4">
               <img src="{{ asset('/images/mobile.png') }}" class="w-auto mx-auto" alt="CHERISH">
               <h4 class="font-20 fw-bold text-main text-uppercase ls-2 py-3">お問い合わせ</h4>
               <p class="fw-normal jost-font font-16 pb-1"> <a href="tel:080XXXXXXXX" class="text-a">080 XXXX XXXX</a>
               </p>
               <p class=" fw-normal jost-font font-16"><a href="mailto:cherish.fukuoka260101@gmail.com"
                  class="text-a">cherish.fukuoka260101@gmail.com</a></p>
            </div>
            <div class="col-lg-4 col-sm-4">
               <img src="{{ asset('/images/clock.png') }}" class="w-auto mx-auto" alt="CHERISH">
               <h4 class="font-20 fw-bold text-main text-uppercase ls-2  py-3">営業時間</h4>
               <p class="fw-normal jost-font font-16 pb-1 text-a"> 10時半～18時半最終入店</p>
               <p class=" fw-normal jost-font font-16 pb-1 text-a"> 定休日：月曜日、木曜日</p>
            </div>
            <div class="col-lg-4 col-sm-4">
               <img src="{{ asset('/images/location.png') }}" class="w-auto mx-auto" alt="CHERISH">
               <h4 class="font-20 fw-bold text-main text-uppercase ls-2 py-3">所在地</h4>
               <p class=" fw-normal jost-font font-16 pb-1 text-a">1-chōme-206</p>
               <p class=" fw-normal jost-font font-16 pb-1 text-a"> Hikida, Kanazawa, Ishikawa</p>
               <p class=" fw-normal jost-font font-16 pb-1 text-a">920-0003, Japan</p>
            </div>
         </div>
      </div>
      <footer class="footer-section py-5 bg-second">
         <div class="container">
            <div class="row gy-4 justify-content-between">
               <!-- Brand -->
               <div class="col-6 col-sm-4 col-lg-3">
                  <a href="{{ route('home') }}" title="CHERISH | Home Page" class="d-inline-block">
                  <img src="{{ asset('/images/log02.png') }}" class="img-fluid" alt="CHERISH logo"
                     loading="lazy" width="320" height="120">
                  </a>
               </div>
               <!-- Quick Links -->
               <nav class="col-6 col-sm-5 col-lg-4" aria-label="Quick links">
                  <h4 class="h6 fw-bold text-main text-uppercase pt-lg-0 pt-sm-0 pt-4 pb-3 m-0">リンク</h4>
                  <ul class="list-unstyled m-0 p-0">
                     <li class="pb-2">
                        <i class="fa-solid fa-right-long me-2"></i>
                        <a href="#home" class="font-15 fw-semibold jost-font text-main hvr-forward">ホーム</a>
                     </li>
                     <li class="pb-2">
                        <i class="fa-solid fa-right-long me-2"></i>
                        <a href="#about" class="font-15 fw-semibold jost-font text-main hvr-forward">私たちについて</a>
                     </li>
                     <li class="pb-2">
                        <i class="fa-solid fa-right-long me-2"></i>
                        <a href="#services" class="font-15 fw-semibold jost-font text-main hvr-forward">サービス一覧</a>
                     </li>
                     <li class="pb-2">
                        <i class="fa-solid fa-right-long me-2"></i>
                        <a href="#story" class="font-15 fw-semibold jost-font text-main hvr-forward">Cherish のストーリー</a>
                     </li>
                     <li class="pb-2">
                        <i class="fa-solid fa-right-long me-2"></i>
                        <a href="#contact" class="font-15 fw-semibold jost-font text-main hvr-forward">お問い合わせ</a>
                     </li>
                  </ul>
               </nav>
               <!-- Contact / Social -->
               <div class="col-12 col-sm-12 col-lg-4 text-start">
                  <h3 class="h6 fw-bold text-main text-uppercase pt-lg-0 pt-sm-0 pt-4 pb-3 m-0">お支払方法</h3>
                  <div class="row g-3">

                     <div class="col-lg-2 col-sm-2 col-2 text-center">
                        <i class="fa-solid fa-money-bill-wave fa-2x text-main"></i>
                        <h5 class="mb-0  fw-bolder jost-font font-12">現金</h5>
                     </div>
                     <!-- Card Payment -->
                     <div class="col-lg-7 col-sm-7 col-4">
                        <img src="{{ asset('/images/visa.png') }}" class="img-fluid" alt="CHERISH logo" >
                     </div>
                     <!-- Cash Payment -->
                     
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <div class="container-fluid container-footer-copyright py-3 ">
         <div class="container jost-font text-center">
            <div class="row">
               <div class="col-xs-12">
                  <p class="company-name">
                     Copyright © 2026 CHERISH 
                     {{-- |
                     Design by <a href="https://onemaxweb.com" target="_blank" class="text-dark fw-bolder">
                     OneMaxWeb Solution --}}
                     </a>
                  </p>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery (latest) -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <!-- Bootstrap 5 JS (bundle includes Popper) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="{{ url('js/lightbox-plus-jquery.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
   </body>
   <script>
      document.getElementById("year").textContent = new Date().getFullYear();
      
      
       
      
      
      
      
      
      
      
      
      
      
       
   </script>

   <script>
document.addEventListener('DOMContentLoaded', function () {
  var $el = $('#customers-testimonials');
  if (!$el.length) return;

  var count = {{ count($testimonials) }}; // Blade renders the number
  var show = Math.min(2, Math.max(1, count)); // 1 if only one, else 2

  $el.owlCarousel({
    loop: count > 1,            // don't loop if there’s only one slide
    center: count > 1,
    items: show,
    margin: 10,
    autoplay: false,
    autoplayTimeout: 4500,
    smartSpeed: 450,
    dots: true,
    nav: false,
    responsive: {
      0:   { items: 1, stagePadding: 30, margin: 10 },
      600: { items: show, stagePadding: 80 },
      1000:{ items: show, stagePadding: 50 }
    }
  });
});





document.addEventListener('DOMContentLoaded', function () {
  var $el = $('.service-carousel');
  if (!$el.length) return;

  var count = {{ count($testimonials) }}; // Blade renders the number
  var show = Math.min(2, Math.max(1, count)); // 1 if only one, else 2

  $el.owlCarousel({
    loop: count > 1,            // don't loop if there’s only one slide
    center: count > 1,
    items: show,
    margin: 10,
    autoplay: false,
    autoplayTimeout: 4500,
    smartSpeed: 450,
    dots: true,
    nav: false,
    responsive: {
      0:   { items: 1, stagePadding: 30, margin: 10 },
      600: { items: show, stagePadding: 80 },
      1000:{ items: show, stagePadding: 50 }
    }
  });
});





</script>

</html>