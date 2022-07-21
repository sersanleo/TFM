from django.contrib.auth import get_user_model
from django.forms import *

from .models import Pet


class PetForm(ModelForm):
    class Meta:
        model = Pet
        exclude = ('created_at', 'updated_at')
        widgets = {'birthday': DateInput(format='%Y-%m-%d', attrs={'type': 'date'}),
                   'annotations': Textarea(attrs={'style': 'height:7rem'})}

    def __init__(self,  *args, **kwargs):
        kwargs['label_suffix'] = ''
        super().__init__(*args, **kwargs)

        for field in self.fields.values():
            if type(field.widget) == Select:
                class_name = 'form-select'
            elif type(field.widget) == CheckboxInput:
                class_name = 'form-check-input'
            else:
                class_name = 'form-control'
            field.widget.attrs.update(
                {'class': class_name, 'placeholder': field.label})

    def is_valid(self):
        result = super().is_valid()
        for x in (self.fields if '__all__' in self.errors else self.errors):
            attrs = self.fields[x].widget.attrs
            attrs.update({'class': attrs.get('class', '') + ' is-invalid'})
        return result
