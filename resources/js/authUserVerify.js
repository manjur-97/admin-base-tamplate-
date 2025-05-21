import {  usePage } from "@inertiajs/vue3";


export const authUserVerify = () => {
    const { props: pageProps } = usePage();
    const authKeys = Object.keys(pageProps.auth);
    const activeAuthKey = authKeys.findIndex((key) => pageProps.auth[key] !== null);
    const activeAuth = authKeys[activeAuthKey];

    return activeAuth; // Return only the activeAuth
};
