import {helpers} from "@vuelidate/validators";

export const letters = helpers.withParams(
    {type: 'letters'},
    value => !helpers.req(value) || /^\p{L}+$/u.test(value)
);

export const address = helpers.withParams(
    {type: 'address'},
    value => !helpers.req(value) || /^[А-Яа-яЁёa-zA-Z0-9\s,'-éü\u00A0;,.]*$/.test(value)
);

export const telephone = helpers.withParams(
    {type: 'telephone'},
    value => !helpers.req(value) || /^(\+?\d{1,3}\s?)?[\d\s-]{5,}$/.test(value)
)

export const requiredContainNumbers = helpers.withParams(
    {type: 'requiredContainNumbers'},
    value => !helpers.req(value) || /\d/.test(value)
)
