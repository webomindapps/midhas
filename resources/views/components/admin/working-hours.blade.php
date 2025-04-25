@props([
    'items' => null,
])

<h6>Working Hours</h6>
<table class="table">
    <thead>
        <tr>
            <th>Day</th>
            <th>Status</th>
            <th>Opens At</th>
            <th>Closes At</th>
        </tr>
    </thead>
    <tbody>

        @if ($items && count($items) > 0)
            @foreach ($items as $item)
                <tr>
                    <input type="hidden" name="ids[]" value="{{ $item->id }}">
                    <td><input type="text" name="day[]" value="{{ $item->day }}" readonly></td>
                    <td>
                        <select name="status[]">
                            <option @if ($item->status == 'open') selected @endif value="open">Open</option>
                            <option @if ($item->status == 'close') selected @endif value="close">Close</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="opens_at[]" value="{{ $item->opens_at }}">
                    </td>
                    <td>
                        <input type="text" name="closes_at[]" value="{{ $item->closes_at }}">
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Mon" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Tue" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Wed" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Thu" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Fri" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Sat" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
            <tr>
                <input type="hidden" name="ids[]" value="{{ null }}">
                <td><input type="text" name="day[]" value="Sun" readonly></td>
                <td>
                    <select name="status[]">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="opens_at[]">
                </td>
                <td>
                    <input type="text" name="closes_at[]">
                </td>
            </tr>
        @endif
    </tbody>
</table>
