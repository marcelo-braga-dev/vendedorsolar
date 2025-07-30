<div class="body">
    <table id="tabela" >
        <tr>
            <th colspan="{{ count($bancos) }}" style="padding: 10px">
                <span style="color: black; font-size: 18px"><b>Financiamentos</b></span>
            </th>
        </tr>
        <tr style=" border:1px solid white;">
            @foreach($bancos as $items)
                <td style="background-color:white; padding: 10px; text-align: center">
                    <img src="storage/{{ $items->img_logo }}" width="80" alt="bancos">
                </td>
            @endforeach
        </tr>
    </table>
</div>
