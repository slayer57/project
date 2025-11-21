<div class="form-group">
    <div class="panel panel-default">
        <div class="panel-header">
            <h4>Categories</h4>
        </div>

        <div class="panel-body product_category">
            <ul style="padding-left:0" class="category_checkbox">
                @foreach ($categories as $category)
                    <li>
                        <input type="checkbox" name="category[]" class=""
                            @if (in_array($category->id, $productCategories)) {{ 'checked' }} @endif
                            value="{{ $category->id }}"><label for="option">{{ $category->name }}</label>
                        <ul>
                            @php
                                $subCategories = getChildCategories($category->id);
                            @endphp

                            @if ($subCategories)
                                @foreach ($subCategories as $sub)
                                    <li>
                                        <input type="checkbox"
                                            @if (in_array($sub->id, $productCategories)) {{ 'checked' }} @endif
                                            name="category[]" class="" value="{{ $sub->id }}">
                                        <label>{{ $sub->name }}</label>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
