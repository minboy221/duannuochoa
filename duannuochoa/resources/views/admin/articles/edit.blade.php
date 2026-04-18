@extends('layouts.admin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea[name="content"]',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount emoticons',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | alignleft aligncenter alignright alignjustify | numlist bullist indent outdent | emoticons charmap | removeformat preview code',
            menubar: 'file edit insert view format table tools',
            height: 500,
            language: 'vi',
            branding: false,
            promotion: false,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            content_style: 'body { font-family:Plus Jakarta Sans,Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
    <main class="flex-1 p-8 ml-64 min-h-screen bg-slate-50">
        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="flex items-center gap-4 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <a href="{{ route('admin.articles.index') }}" class="p-2.5 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-100 transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight font-headline">Chỉnh sửa bài viết</h2>
                    <p class="text-slate-500 font-medium text-xs">Cập nhật nội dung cho bài viết ID: #{{ $article->article_id }}</p>
                </div>
            </div>

            <form action="{{ route('admin.articles.update', $article->article_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Sidebar: Image & Status -->
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                            <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider">Hình ảnh đại diện</h3>
                            <div class="aspect-video rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden group relative">
                                <img id="image-preview" src="{{ $article->image ? asset('storage/' . $article->image) : '' }}" 
                                     class="{{ $article->image ? '' : 'hidden' }} w-full h-full object-cover">
                                <div id="upload-placeholder" class="{{ $article->image ? 'hidden' : '' }} text-center">
                                    <span class="material-symbols-outlined text-slate-300 text-4xl">image</span>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase mt-2">Chọn ảnh mới (.jpg, .png)</p>
                                </div>
                                <input type="file" name="image" onchange="previewImage(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-2 italic">* Để trống nếu không muốn đổi ảnh</p>
                            @error('image') <p class="text-rose-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                            <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider">Cài đặt xuất bản</h3>
                            <div class="space-y-4">
                                <label class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 cursor-pointer border border-transparent hover:border-blue-200 transition-all">
                                    <input type="radio" name="status" value="1" {{ $article->status ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">Công khai</p>
                                        <p class="text-[10px] text-slate-400">Hiện ngay trên website</p>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 cursor-pointer border border-transparent hover:border-blue-200 transition-all">
                                    <input type="radio" name="status" value="0" {{ !$article->status ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">Bản nháp</p>
                                        <p class="text-[10px] text-slate-400">Lưu lại để sửa sau</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="md:col-span-2 space-y-6">
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Tiêu đề bài viết</label>
                                <input type="text" name="title" value="{{ old('title', $article->title) }}" 
                                       class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-slate-800 font-bold focus:ring-2 focus:ring-blue-600/20 transition-all"
                                       placeholder="Nhập tiêu đề hấp dẫn...">
                                @error('title') <p class="text-rose-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Tóm tắt ngắn</label>
                                <textarea name="summary" rows="3"
                                          class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-slate-600 font-medium focus:ring-2 focus:ring-blue-600/20 transition-all resize-none"
                                          placeholder="Viết một đoạn ngắn giới thiệu bài viết...">{{ old('summary', $article->summary) }}</textarea>
                                @error('summary') <p class="text-rose-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Nội dung bài viết</label>
                                <textarea name="content" rows="15" 
                                          class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-slate-600 font-medium focus:ring-2 focus:ring-blue-600/20 transition-all"
                                          placeholder="Bắt đầu viết nội dung tại đây...">{{ old('content', $article->content) }}</textarea>
                                @error('content') <p class="text-rose-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                                Cập nhật bài viết
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="px-10 py-4 bg-white text-slate-500 font-bold rounded-2xl hover:bg-slate-50 transition-all border border-slate-100 active:scale-95">
                                Hủy bỏ
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
