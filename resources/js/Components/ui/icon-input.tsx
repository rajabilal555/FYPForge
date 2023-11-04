import * as React from "react";
import {cn} from "@/lib/utils";
import {cva, VariantProps} from "class-variance-authority";
import {LucideProps} from "lucide-react";


const InputVariants = cva(
    "relative",
    {
        variants: {
            iconPosition: {
                left: "absolute left-3 top-1/2 -translate-y-1/2 transform text-muted-foreground",
                right: "absolute left-auto right-3 top-1/2 -translate-y-1/2 transform text-muted-foreground",
            },
        },
        defaultVariants: {
            iconPosition: "left",
        },
    }
)

export interface InputProps
    extends React.InputHTMLAttributes<HTMLInputElement>, VariantProps<typeof InputVariants> {
    icon?: React.ComponentType<LucideProps>;
}

const IconInput = React.forwardRef<HTMLInputElement, InputProps>(
    ({className, icon: Icon, iconPosition, type, ...props}, ref) => {
        return (
            <div className="relative flex items-center">
                <span className={cn(InputVariants({iconPosition}))}>
                    {Icon != null && <Icon size={16}/>}
                </span>
                <input
                    type={type}
                    className={cn(
                        "flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50",
                        className,
                        Icon ? iconPosition !== 'right' ? 'pl-10 pr-4' : 'pl-4 pr-10' : ''
                    )}
                    ref={ref}
                    {...props}
                />
            </div>
        );
    },
);
IconInput.displayName = "IconInput";

export {IconInput};
