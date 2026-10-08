function FieldError({errors,field}) {
    if(!errors?.[field]){
        return null;
    }
    return(
        <div className="invalid-feedback">
            {errors[field][0]}
        </div>
    );

}

export default FieldError;