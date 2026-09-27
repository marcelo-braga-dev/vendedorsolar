<div class="body" style="font-family:sans-serif;">
    <span style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Financiamento facilitado com</span>
    <table style="width:100%; margin-top:12px;">
        <tr>
            @foreach($bancos as $items)
                <td style="text-align:center; padding:6px;">
                    <img src="storage/{{ $items->img_logo }}" width="70" alt="banco">
                </td>
            @endforeach
        </tr>
    </table>
</div>
