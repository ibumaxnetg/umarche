<x-app-layout>
  <x-slot name="header">owner
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <!-- flash-message -->
                <x-flash-message status="session('status')" />

                  <form method="POST" action="{{ route('owner.products.update', ['product' => $product->id ] ) }}">
                    @csrf
                    @method('put')

                    <div class="-m-2">
                      <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">商品名 ※必須</label>
                            <input type="text" id="name" name="name" required value="{{ $product->name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="information" class="leading-7 text-sm text-gray-600">商品情報</label>
                            <textarea id="information" name="information" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $product->information }}</textarea>
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="price" class="leading-7 text-sm text-gray-600">価格</label>
                            <input type="text" id="price" name="price" required value="{{ $product->price }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="sort_order" class="leading-7 text-sm text-gray-600">表示順</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ $product->sort_order }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="current_quantity" class="leading-7 text-sm text-gray-600">在庫 ※必須</label>
                            <input type="hidden" id="current_quantity" name="current_quantity" required value="{{ $quantity }}">
                            <div class="w-full bg-gray-100 bg-opacity-50 rounded text-base outline-none text-gray-700 py-1 px-3 leading-8">{{ $quantity }}</div>
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative flex justify-around">
                            <label><input type="radio" name="type" value="{{ \Constant::PRODUCT_LIST['add'] }}" checked class="mr-2" />追加</label>
                            <label><input type="radio" name="type" value="{{ \Constant::PRODUCT_LIST['reduce'] }}" class="mr-2" />削除</label>
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="quantity" class="leading-7 text-sm text-gray-600">数量 ※必須</label>
                            <input type="number" id="quantity" name="quantity" required value="{{ $product->quantity }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <span class="text-sm">0〜99の範囲で入力してください</span>
                          </div>
                        </div>

                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="shop_id" class="leading-7 text-sm text-gray-600">販売店舗ID</label>
                            <select name="shop_id" id="shop_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @foreach ($shops as $shop)
                              <option value="{{ $shop->id }}" @if($shop->id === $product->shop_id) selected @endif >
                                  {{ $shop->name }}
                              </option>
                            @endforeach
                            </select>
                          </div>
                        </div>


                        <div class="p-2 w-1/2 mx-auto">
                      <div class="relative">
                        <label for="category" class="leading-7 text-sm text-gray-600">カテゴリ</label>
                        <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          @foreach($categories as $category)
                              <optgroup label="{{ $category->name }}">
                              @foreach($category->secondary as $secondary)
                                <option value="{{ $secondary->id}}" @if($secondary->id === $product->secondary_category_id) selected @endif >
                                    {{ $secondary->name }}
                                </option>
                              @endforeach
                          @endforeach
                          </select>
                      </div>
                    </div>

                    <x-select-image :images="$images" name="image1" currentId="{{ $product->image1 }}" currentImage="{{ $product->imageFirst->filename ?? '' }}" />
                    <x-select-image :images="$images" name="image2" currentId="{{ $product->image2 }}" currentImage="{{ $product->imageSecond->filename ?? '' }}" />
                    <x-select-image :images="$images" name="image3" currentId="{{ $product->image3 }}" currentImage="{{ $product->imageThird->filename ?? '' }}" />
                    <x-select-image :images="$images" name="image4" currentId="{{ $product->image4 }}" currentImage="{{ $product->imageFourth->filename ?? '' }}" />
                    <x-select-image :images="$images" name="image5" />

                    <div class="p-2 w-1/2 mx-auto">
                      <div class="relative flex justify-around">
                        <label><input type="radio" name="is_selling" value="1" checked class="mr-2" @if ($product->is_selling === 1) { checked } @endif />販売中</label>
                        <label><input type="radio" name="is_selling" value="0" class="mr-2" @if ($product->is_selling === 2) { checked } @endif />販売停止中</label>
                      </div>
                    </div>

                    <div class="p-2 w-full flex justify-around mt-4">
                      <button type="button" onclick="location.href='{{ route('owner.products.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">もどる</button>
                      <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                    </div>
                    </div>
                  </form>

                  <form id="delete_{{ $product->id }}" method="POST" action="{{ route('owner.products.destroy', ['product' => $product->id ]) }}">
                    @method('delete')
                    @csrf
                    <div class="p-2 w-full flex justify-around mt-16">
                      <a href="#" data-id="{{ $product->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-400 rounded text-lg">削除</a>
                    </div>
                  </form>

                  <p><a href="/component-test1">てすと１</a></p>
                  <p><a href="/component-test2">てすと2</a></p>
              </div>
          </div>
      </div>
  </div>
<script>
'use strict';
const images = document.querySelectorAll('.image'); //全てのimageタグを取得
images.forEach(image => { // 1つずつ繰り返す
    image.addEventListener('click', function(e){ // クリックしたら
        const imageName = e.target.dataset.id.substr(0, 6); //data-idの6文字
        const imageId = e.target.dataset.id.replace(imageName + '_', ''); // 6文字カット
        const imageFile = e.target.dataset.file;
        const imagePath = e.target.dataset.path;
        const modal = e.target.dataset.modal;

        // サムネイルと input type=hiddenのvalueに設定
        document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile;
        document.getElementById(imageName + '_hidden').value = imageId;
        MicroModal.close(modal); //モーダルを閉じる
    })
})

function deletePost(e) {
  'use strict';
  if (confirm('本当に削除してもいいですか?')) { document.getElementById('delete_' + e.dataset.id).submit(); }
}

</script>

</x-app-layout>
