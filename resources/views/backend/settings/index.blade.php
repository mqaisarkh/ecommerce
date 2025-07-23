@extends('backend.layouts.main')

@section('content')
    <div class="container mt-5">
        <h3>Settings</h3>
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- General Settings --}}
            <div class="card mb-4">
                <div class="card-header">General Settings</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Site Name</label>
                            <input name="site_name" type="text"
                                class="form-control @error('site_name') is-invalid @enderror" id="site_name"
                                placeholder="Site Name"
                                value="{{ old('site_name', setting('site_name', 'Default Site')) }}" />
                            @error('site_name')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Favicon</label>
                            <input name="favicon" type="file" class="form-control @error('favicon') is-invalid @enderror"
                                id="favicon" placeholder="Site Logo" value="{{ old('favicon', setting('favicon')) }}" />
                            @error('favicon')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Site Logo(Dark)</label>
                            <input name="logo_dark" type="file"
                                class="form-control @error('logo_dark') is-invalid @enderror" id="logo_dark"
                                placeholder="Site Logo" value="{{ old('logo_dark', setting('logo_dark')) }}" />
                            @error('logo_dark')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Site Logo(White)</label>
                            <input name="logo_white" type="file"
                                class="form-control @error('logo_white') is-invalid @enderror" id="logo_white"
                                placeholder="Site Logo" value="{{ old('logo_white', setting('logo_white')) }}" />
                            @error('logo_white')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Contact</label>
                            <input name="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                                id="contact" placeholder="Contact" value="{{ old('contact', setting('contact')) }}" />
                            @error('contact')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" placeholder="Address" value="{{ old('address', setting('address')) }}" />
                            @error('address')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Email Configuration --}}
            <div class="card mb-4">
                <div class="card-header">Email Configuration</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="mailer">Mail Mailer</label>
                            <div class="position-relative">
                                <select name="mailer" id="mailer"
                                    class="form-control @error('mailer') is-invalid @enderror pr-4">
                                    <option value="">-- Select Mailer --</option>
                                    <option value="smtp"
                                        {{ old('mailer', setting('mailer')) == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                    <option value="ses"
                                        {{ old('mailer', setting('mailer')) == 'ses' ? 'selected' : '' }}>SES</option>
                                    <option value="postmark"
                                        {{ old('mailer', setting('mailer')) == 'postmark' ? 'selected' : '' }}>Postmark
                                    </option>
                                    <option value="resend"
                                        {{ old('mailer', setting('mailer')) == 'resend' ? 'selected' : '' }}>Resend
                                    </option>
                                    <option value="sendmail"
                                        {{ old('mailer', setting('mailer')) == 'sendmail' ? 'selected' : '' }}>Sendmail
                                    </option>
                                    <option value="log"
                                        {{ old('mailer', setting('mailer')) == 'log' ? 'selected' : '' }}>Log</option>
                                    <option value="array"
                                        {{ old('mailer', setting('mailer')) == 'array' ? 'selected' : '' }}>Array</option>
                                    <option value="failover"
                                        {{ old('mailer', setting('mailer')) == 'failover' ? 'selected' : '' }}>Failover
                                    </option>
                                    <option value="roundrobin"
                                        {{ old('mailer', setting('mailer')) == 'roundrobin' ? 'selected' : '' }}>Roundrobin
                                    </option>
                                </select>
                                <!-- Dropdown icon -->
                                <span class="position-absolute"
                                    style="top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </div>
                            @error('mailer')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Mail Host</label>
                            <input name="host" type="text" class="form-control @error('host') is-invalid @enderror"
                                id="host" placeholder="Host" value="{{ old('host', setting('host')) }}" />
                            @error('host')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="port">Mail Port</label>
                            <div class="position-relative">
                                <select name="port" id="port"
                                    class="form-control @error('port') is-invalid @enderror pr-4">
                                    <option value="">-- Select Port --</option>
                                    <option value="25" {{ old('port', setting('port')) == '25' ? 'selected' : '' }}>
                                        25 (SMTP)</option>
                                    <option value="465" {{ old('port', setting('port')) == '465' ? 'selected' : '' }}>
                                        465 (SSL)</option>
                                    <option value="587" {{ old('port', setting('port')) == '587' ? 'selected' : '' }}>
                                        587 (STARTTLS)</option>
                                    <option value="2525" {{ old('port', setting('port')) == '2525' ? 'selected' : '' }}>
                                        2525 (Alternative SMTP)</option>
                                </select>
                                <!-- Dropdown icon -->
                                <span class="position-absolute"
                                    style="top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </div>
                            @error('port')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Mail Username</label>
                            <input name="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                placeholder="Username" value="{{ old('username', setting('username')) }}" />
                            @error('username')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Mail Password</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Password" value="{{ old('password', setting('password')) }}" />
                            @error('password')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Mail Encryption</label>
                            <input name="mail_encryption" type="text"
                                class="form-control @error('mail_encryption') is-invalid @enderror" id="mail_encryption"
                                placeholder="Mail Encryption"
                                value="{{ old('mail_encryption', setting('mail_encryption')) }}" />
                            @error('mail_encryption')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stripe Settings --}}
            <div class="card mb-4">
                <div class="card-header">Stripe Configuration</div>
                <div class="card-body">
                    <div class="col-md-6 mb-3">
                        <label>Stripe Key</label>
                        <input name="stripe_key" type="text"
                            class="form-control @error('stripe_key') is-invalid @enderror" id="stripe_key"
                            placeholder="Stripe Key" value="{{ old('stripe_key', setting('stripe_key')) }}" />
                        @error('stripe_key')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Stripe Secret</label>
                        <input name="stripe_secret" type="text"
                            class="form-control @error('stripe_secret') is-invalid @enderror" id="stripe_secret"
                            placeholder="Stripe Secret" value="{{ old('stripe_secret', setting('stripe_secret')) }}" />
                        @error('stripe_secret')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary ml-4">Save Settings</button>
        </form>
    </div>
@endsection
