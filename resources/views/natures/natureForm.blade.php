
                        <div class="form-group col-md-10 row">
                            <label for="name" class="col-md-2 col-form-label text-md-right"><strong>Nom </strong> </label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $nature->name ?? ' ' }}" required autofocus> @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span> @enderror
                            </div>
                        </div>



