export function formatMoney(amount, currency = 'USD') {
    return amount.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        style: 'currency',
        currency: currency,
    }).replace('.00', '')
}

export default { formatMoney }
