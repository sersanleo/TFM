from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
from django.http import Http404
from django.shortcuts import redirect, render


@login_required
def edit(request, pk=None):
    if pk:
        appointment = Appointment.objects.visible_by(
            request.user).filter(pk=pk)
        if appointment.exists():
            appointment = appointment.first()
        else:
            raise Http404()
    else:
        appointment = Appointment()

    if request.method == 'POST':
        form = AppointmentForm(
            request.user, request.POST, instance=appointment)
        if form.is_valid():
            form.save()
            return redirect('appointment:')
    else:
        form = AppointmentForm(request.user, instance=appointment)
    return render(request, 'appointment/edit.html', {'form': form})


@login_required
def delete(request):
    if request.method == 'POST':
        Appointment.objects.visible_by(request.user).filter(
            pk=request.POST['appointment']).delete()
    return redirect('appointment:')


@login_required
def list(request):
    return render(request, 'appointment/list.html', {
        'page_obj': Paginator(Appointment.objects.visible_by(request.user), 10).get_page(request.GET.get('page', 1))
    })
