<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Category Create</h3>
                        <div class="card-toolbar">
                            <x-metronic.button class="primary" isLink=false href="{{ route('admin.categories.index') }}">
                                {{ __('Back') }}
                            </x-metronic.button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <x-metronic.label for="parent_id"
                                    class="col-form-label fw-bold fs-6">{{ __('Select a parent Category') }}</x-metronic.label>
                                <x-metronic.select-option id="parent_id" name="parent_id" data-hide-search="false"
                                    data-placeholder="Select an option">
                                    <option></option>
                                    {!! $categoriesOptions !!}
                                </x-metronic.select-option>
                            </div>

                            <div class="col-lg-5">
                                <x-metronic.label for="name"
                                    class="col-form-label required fw-bold fs-6">{{ __('Category Name') }}</x-metronic.label>
                                <x-metronic.input id="name" type="text" name="name"
                                    placeholder="Enter the name"></x-metronic.input>
                            </div>

                            <div class="col-lg-2">
                                <x-metronic.label for="status" class="col-form-label required fw-bold fs-6">
                                    {{ __('Select a Status ') }}</x-metronic.label>
                                <x-metronic.select-option id="status" name="status" data-hide-search="true"
                                    data-placeholder="Select an option">
                                    <option></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </x-metronic.select-option>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <x-metronic.button type="submit" class="success">
                                {{ __('Save Changes') }}
                            </x-metronic.button>
                            <!--end::Button-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-app-layout>
