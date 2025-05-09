<tempalte
    x-data="{ request: @js($request) || {}, submitted: $wire.entangle('submitted').live }"
    @setup-request-form.window="request = $event.detail.request; $wire.setRequest(request); $dispatch('open-modal', { modal: 'create-helpdesk-request' });"
    @modal-closed-create-helpdesk-request.window="$wire.clear();"
>
    <x-modal id="create-helpdesk-request">
        <form wire:submit.prevent="submit" @class(['form helpdesk-request-form', 'success' => $submitted])>
            <div class="heading">
                <h3 class="heading__title" x-text="!submitted ? (request.name ?? 'New Request') : 'Ticket Submitted'"></h3>
            </div>

            <p class="my-1" x-text="!submitted ? (request.description ?? '') : 'Thank you. Your ticket has been submitted. You should hear back from us shortly.'"></p>

            @if($submitted)
                <div class="helpdesk-request-form__footer">
                    <button type="button" class="button button--primary" @click="$dispatch('close-modal', { modal: 'create-helpdesk-request' })">
                        Close
                    </button>
                </div>
            @else
                <label for="requester" class="form__field">
                    <span class="form__label">
                        <span>Raise this request on behalf of*</span>

                        @if ($errors->has('requester'))
                            <span class="form__error">{{ $errors->first('requester') }}</span>
                        @endif
                    </span>

                    @php
                        $user = Auth::user();
                        $icon = $user->avatar ? "<img class='avatar' src='$user->avatar' alt='' />" : "<x-heroicon-o-user class='avatar' />";
                        $label = Blade::render("<span class='inline-flex items-center gap-2'>$icon <span>$user->name ($user->email)</span> </span>");
                        $options = [
                            ['label' => $label, 'value' => $user->id],
                        ];
                    @endphp
                    <x-select
                        :options="$options"
                        :selected="$requester"
                        id="requester"
                        name="requester"
                        class="form__control"
                        appearance="outline"
                        wire:model.live="requester"
                    />
                </label>

                <label for="summary" class="form__field">
                    <span class="form__label">
                        <span>Summary*</span>

                        @if ($errors->has('summary'))
                            <span class="form__error">{{ $errors->first('summary') }}</span>
                        @endif
                    </span>

                    <input
                        type="text"
                        name="summary"
                        id="summary"
                        class="form__control"
                        placeholder="Brief summary of the problem or question..."
                        wire:model.live="summary"
                    />
                </label>

                <span class="form__field">
                    <span class="form__label">
                        <span>Description*</span>

                        @if ($errors->has('description'))
                            <span class="form__error">{{ $errors->first('description') }}</span>
                        @endif
                    </span>

                    <x-rich-text-editor
                        wire:model="description"
                        placeholder="Please describe your problem or question in detail..."
                    />
                </span>

                <label for="attachment" class="form__field">
                    <span class="form__label">
                        <span>Attachment</span>

                        @if ($errors->has('attachment'))
                            <span class="form__error">{{ $errors->first('attachment') }}</span>
                        @endif
                    </span>

                    <div x-data="{ files: null }" class="file-input">
                        <div class="file-input__container">
                            <input
                                type="file"
                                name="attachment"
                                id="attachment"
                                class="file-input__control"
                                x-ref="input"
                                wire:model.live="attachment"
                                x-on:change="files = $event.target.files?.length ? $event.target.files : null;"
                            />

                            <template x-if="files !== null">
                                <div class="file-input__value">
                                    <template x-for="(_,index) in Array.from({ length: files.length })">
                                        <div class="file-input__line">
                                            <template x-if="files[index].type.includes('audio/')">
                                                <x-heroicon-o-speaker-wave />
                                            </template>

                                            <template x-if="files[index].type.includes('image/')">
                                                <x-heroicon-o-photo />
                                            </template>

                                            <template x-if="files[index].type.includes('video/')">
                                                <x-heroicon-o-video-camera />
                                            </template>

                                            <span x-text="files[index].name">Uploading</span>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="files === null">
                                <p class="file-input__placeholder">Drag and drop or upload an attachment...</p>
                            </template>
                        </div>

                        <button type="button" class="button button--primary file-input__button" @click="$refs.input.click()">
                            <x-heroicon-o-arrow-up-tray />

                            Upload
                        </button>
                    </div>
                </label>

                @if ($errors->any())
                    <ul class="error-list">
                        <span class="error-list__label">Form errors</span>

                        @foreach ($errors->all() as $error)
                            <li class="error-list__item">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="helpdesk-request-form__footer">
                    <button
                        type="button"
                        class="button button--secondary"
                        @click="$dispatch('close-modal', { modal: 'create-helpdesk-request' })"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="button button--primary"
                        wire:target="submit"
                        wire:loading.attr="disabled"
                    >
                        Submit

                        <span wire:loading wire:target="submit">
                            <x-heroicon-o-arrow-path class="animate-spin" />
                        </span>
                    </button>
                </div>
            @endif
        </form>
    </x-modal>
</tempalte>
