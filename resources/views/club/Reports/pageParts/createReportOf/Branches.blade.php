
              <hr>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <label for="name">{{trans('club.assignPlaygrounds')}}</label>
                </div>
                @foreach ($club->clubPlaygrounds as $playground)
                  <div class="col-lg-4">
                      @if ($playground->name != 'post')
                        <div class="checkbox">
                          <label><input type="checkbox" name="playgrounds[]" value="{{ $playground->id }}">{{ $playground->c_b_p_name }}</label>
                        </div>
                      @endif
                  </div>
                @endforeach
              </div>
              <br><br>
