# ossn-turnstile
This component adds a CloudFlare turnstile as a Captcha replacement to your OSSN site's signup and reset password pages. This is basically my edited hCaptcha component that is based on the earlier Google ReCaptcha v2 component.

## What inspires me to do this?
The OSSN Community website inspires me to do this component. When I will sign-in to the OSSN Community website, the CloudFlare Anti-DDOS with Turnstile checks my traffic.

## What I need?
The Site Key and the Secret Key. To have those, follow these steps.
<br>
1.) You need to integrate your site with CloudFlare<br>
2.) If you already did the step 1, just go to left menu and click Turnstile.<br>
3.) Finally, create that new one.<br>
4.) Add your domain and select the mode (Managed,  Non-Interactive, Invisible)<br>
5.) Create that and copy your keys.<br>
6.) Go to your /administrator page and click the Configure in the dropdown menu.<br>
7.) Select turnstile and copy-paste the keys.
