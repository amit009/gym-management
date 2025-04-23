<div>
    <div class="form-group row">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="need-pt">Need Personal Trainer?</label>
        <div class="col-md-6 col-sm-6" wire:ignore>                                         
            <label>
                <input type="checkbox" name="need_trainer" id="need-pt" class="js-switch" wire:model="showTrainerOption" /> 
            </label>                                         
        </div>
    </div>
    @if($showTrainerOption)
    <div class="row form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="trainer">Trainer</label>
        <div class="col-md-6 col-sm-6 ">
            <select id="trainer" name="trainer_id" class="form-control"> 
                <option value="1" data-month="1">Manish</option> 
                <option value="2" data-month="3">Don</option> 
            </select> 
        </div>
    </div>
    @endif
</div>
