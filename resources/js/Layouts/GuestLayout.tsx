import ApplicationLogo from "@/Components/ApplicationLogo";
import {Link} from "@inertiajs/react";
import {PropsWithChildren} from "react";

export default function Guest({
                                  subtitle,
                                  children,
                              }: PropsWithChildren<{ subtitle?: String }>) {
    return (
        <div className="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 ">
            <div>
                <Link href="/">
                    <ApplicationLogo className="w-20 h-20 text-gray-500 fill-current"/>
                </Link>
                <p className="mt-2 text-center text-gray-500">{subtitle}</p>
            </div>

            <div className="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
