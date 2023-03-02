<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4></h4>
            <div class="card-header-form">
                <button type="button" wire:click="showCreateForm()" class="btn btn-primary">@lang('Add new sub-category')</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Category')</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($subCategories as $subCategory)
                        <tr wire:key="{{ $loop->index }}">
                            <td class="p-0 text-center">{{ $loop->iteration }}</td>
                            <td>{{ $subCategory->name }}</td>
                            <td>{{ $subCategory->category->name }}</td>
                            <td>
                                <button wire:click="showEditForm({{ $subCategory->id }})" class="btn btn-primary"><i class="fas fa-pen"></i></button>
                                <button wire:click="showDeleteModal({{ $subCategory->id }})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $subCategories->links('vendor.livewire.bootstrap') }}
            </nav>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.sub-categories.sub-category-modal')
    
    @if ($selectedSubCategory)
        @include('admin.sub-categories.delete-modal')
    @endif
</div>