@extends('layouts.profile')

@section("myportfolios")
<section>
   <header class="header" id="header">
      <script>
         function toggleAddPortfolioForm() {
            const form = document.getElementById('addPortfolioForm');
            form.classList.toggle('d-none');
         }

         function hideAddPortfolioForm() {
            const form = document.getElementById('addPortfolioForm');
            form.classList.add('d-none');
         }

         <!-- Bootstrap CSS -->
      
      </script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap JS (for modal functionality) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

      <div class="header__container">
         <a href="{{ route('my-profile', auth()->user()->id) }}" class="header__logo">
            <div class="sidebar__info mx-2">
               <h3><p class="text-end font-semibold">{{ auth()->user()->name }}</p></h3>
               <span>{{ auth()->user()->email }}</span>
            </div>
            <div class="sidebar__img">
               <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}" 
                    style="height: 100%; width: auto;" alt="profile image">
            </div>
         </a>
         <button class="header__toggle" id="header-toggle">
            <i class="ri-menu-line"></i>
         </button>
      </div>
   </header>

   @include('layouts.partials.sidenav')

   <main class="main mt-4 mx-5" id="main"> 
      <div class="d-grid gap-2">
         <button type="button" class="btn btn-outline-primary btn-lg" onclick="toggleAddPortfolioForm()">
            Add Portfolio
         </button>
      </div>

      <!-- Form Tambah Portfolio -->
      <div id="addPortfolioForm" class="mt-4 d-none">
         <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data" class="border rounded p-4 shadow">
            @csrf
            <h5 class="mb-4">Add New Portfolio</h5>

            <div class="mb-3">
               <label for="title" class="form-label">Title</label>
               <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="mb-3">
               <label for="description" class="form-label">Description</label>
               <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
               <label for="image" class="form-label">Image</label>
               <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
            </div>

            <div class="mb-3">
               <label for="link" class="form-label">Demo/GitHub Link</label>
               <input type="url" class="form-control" name="link" id="link">
            </div>
            
            <div class="mb-3">
               <label for="category" class="form-label">Category</label>
               <select class="form-select" name="category" id="category" required>
                  <option value="">Select Category</option>
                  <option value="web">Web</option>
                  <option value="mobile">Mobile</option>
               </select>
            </div>


            <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-success me-2">Submit</button>
               <button type="button" class="btn btn-secondary" onclick="hideAddPortfolioForm()">Cancel</button>
            </div>
         </form>
      </div>

      <!-- List Portfolio -->
      @foreach ($portfolios as $portfolio)
         <div class="bg-white shadow-md rounded-lg p-4 mt-4 flex flex-row">
            <div class="w-1/6">
               <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Portfolio Image" class="h-40 w-40 object-cover rounded-lg">
            </div>
            <div class="w-5/6 pl-4">
               <h1 class="text-xl font-bold mt-2">{{ $portfolio->title }}</h1>
               @if($portfolio->link)
                  <p class="text-blue-600"><a href="{{ $portfolio->link }}" target="_blank">View Demo</a></p>
               @endif
               <div class="d-grid gap-2 mt-3">
                  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editPortfolioModal{{ $portfolio->id }}">
                     Edit
                  </button>
                  <form action="{{ route('portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Delete this portfolio?');">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger mt-2">Delete</button>
                  </form>
               </div>
            </div>
         </div>

         <!-- Edit Modal -->
         <div class="modal fade" id="editPortfolioModal{{ $portfolio->id }}" tabindex="-1" aria-labelledby="editPortfolioModalLabel{{ $portfolio->id }}" aria-hidden="true">
            <div class="modal-dialog">
               <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                  @csrf
                  @method('PUT')
                  <div class="modal-header">
                     <h5 class="modal-title" id="editPortfolioModalLabel{{ $portfolio->id }}">Edit Portfolio</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="mb-3">
                        <label for="title{{ $portfolio->id }}" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title{{ $portfolio->id }}" value="{{ $portfolio->title }}" required>
                     </div>

                     <div class="mb-3">
                        <label for="description{{ $portfolio->id }}" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description{{ $portfolio->id }}" rows="3" required>{{ $portfolio->description }}</textarea>
                     </div>

                     <div class="mb-3">
                        <label for="image{{ $portfolio->id }}" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image{{ $portfolio->id }}" accept="image/*">
                     </div>

                     <div class="mb-3">
                        <label for="link{{ $portfolio->id }}" class="form-label">Link</label>
                        <input type="url" class="form-control" name="link" id="link{{ $portfolio->id }}" value="{{ $portfolio->link }}">
                     </div>
                     <div class="mb-3">
                        <label for="category{{ $portfolio->id }}" class="form-label">Category</label>
                        <select class="form-select" name="category" id="category{{ $portfolio->id }}" required>
                           <option value="">Select Category</option>
                           <option value="web" {{ $portfolio->category == 'web' ? 'selected' : '' }}>Web</option>
                           <option value="mobile" {{ $portfolio->category == 'mobile' ? 'selected' : '' }}>Mobile</option>
                        </select>
                     </div>
                  </div>
                  


                  <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Save changes</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
               </form>
            </div>
         </div>
      @endforeach
   </main>
</section>
@endsection
