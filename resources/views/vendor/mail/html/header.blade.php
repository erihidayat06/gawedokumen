@props(['url'])

<tr>
    <td class="header" style="padding: 25px 0; text-align: center;">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            {{-- Container dengan Background dan Radius --}}
            <table border="0" cellpadding="0" cellspacing="0"
                style="margin: 0 auto; background-color: #1e293b; padding: 12px 20px; border-radius: 12px; border-collapse: separate;">
                <tr>
                    <td style="vertical-align: middle;">
                        <img src="https://gawedokumen.com/img/icon.png" alt="GaweDokumen Logo"
                            style="max-width: 32px; height: auto; display: block;">
                    </td>
                    <td style="padding-left: 12px; vertical-align: middle;">
                        <span
                            style="font-size: 20px; font-weight: 800; color: #ffffff; font-family: sans-serif; text-shadow: 1px 1px 2px #000000;">
                            Gawe<span style="color: #60a5fa; text-shadow: none;">Dokumen</span>
                        </span>
                    </td>
                </tr>
            </table>
        </a>
    </td>
</tr>
