<div class="modal fade" id="order" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('img/icons/close.svg')}}" alt="close">
            </button>
            <form class="modal-body" method="post" enctype="multipart/form-data">
                <div class="section-title text-center">@trans('Расчет стоимости')</div>
                <div class="row mt-4">
                    <div class="col-lg-6 group-input">
                        <div class="form-group">
                            <input class="custom-select form-control dark date-picker" name="date"
                                   placeholder="@trans('Дата перевозки')">
                        </div>
                        <div class="form-group group-flex">
                            <select class="custom-select form-control dark" name="loading_country">
                                <option selected disabled>@trans('Страна погрузки')</option>
                                @foreach($order['countries'] as $country)
                                    <option>{{$country}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control dark" name="loading_city" placeholder="@trans('Город или код')">
                        </div>
                        <div class="form-group group-flex">
                            <select class="custom-select form-control dark" name="unloading_country">
                                <option selected disabled>@trans('Страна выгрузки')</option>
                                @foreach($order['countries'] as $country)
                                    <option>{{$country}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control dark" name="unloading_city"
                                   placeholder="@trans('Город или код')">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control dark" name="description"
                                   placeholder="@trans('Наименование груза, тоннаж, обьем')">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control dark" name="name" placeholder="@trans('Укажите свое имя')"
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control dark" name="phone" placeholder="@trans('Ваш номер телефона')"
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control dark" name="email" placeholder="@trans('Ваш email')">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group check-flex">
                            <div class="small-size bold-weight label">@trans('Вариант доставки')</div>
                            <div class="check-group">
                                @foreach($order['delivery'] as $method)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="delivery[]"
                                               id="delivery-{{$loop->index}}" value="{{$method}}">
                                        <label class="custom-control-label"
                                               for="delivery-{{$loop->index}}">{{$method}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group check-flex">
                            <div class="small-size bold-weight label">@trans('TIR нужен')</div>
                            <div class="check-group">
                                @foreach($order['tir'] as $method)
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="tir"
                                               id="tir-{{$loop->index}}" {{$loop->index==0?'checked':''}} value="{{$method}}">
                                        <label class="custom-control-label"
                                               for="tir-{{$loop->index}}">{{$method}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group check-flex">
                            <div class="small-size bold-weight label">@trans('Тип транспорта')</div>
                            <div class="check-group">
                                @foreach($order['transport'] as $method)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="transport[]"
                                               id="transport-{{$loop->index}}" value="{{$method}}">
                                        <label class="custom-control-label"
                                               for="transport-{{$loop->index}}">{{$method}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group check-flex">
                            <div class="small-size bold-weight label">@trans('Загрузка')</div>
                            <div class="check-group">
                                @foreach($order['load'] as $method)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="load[]"
                                               id="load-{{$loop->index}}" value="{{$method}}">
                                        <label class="custom-control-label"
                                               for="load-{{$loop->index}}">{{$method}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group check-flex">
                            <div class="small-size bold-weight label">@trans('Фото')</div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo" id="photo">
                                <label class="custom-file-label" for="photo">@trans('Выберите файл')</label>
                                <span class="d-none">@trans('Выберите файл')</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control dark" name="comment" placeholder="@trans('Коментарий')"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-yellow mw-230">@trans('Рассчитать')<span class="spinner-border text-light"></span></button>
                    <input type="hidden" name="subject" value="Расчет стоимости">
                    <input type="hidden" name="action" value="mail">
                </div>
            </form>
        </div>
    </div>
</div>
